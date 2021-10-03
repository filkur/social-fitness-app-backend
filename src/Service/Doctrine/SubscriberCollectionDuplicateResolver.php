<?php

declare(strict_types=1);

namespace App\Service\Doctrine;

use InvalidArgumentException;

class SubscriberCollectionDuplicateResolver
{
    private array $persisted = [];

    /**
     * @param string|object $class - object where objects was manipulated
     */
    public function canBeProceeded(object $object, $class = "all"): bool
    {
        $class = $this->getClassName($class);

        $arrayOfPersistedObjectsInClass = &$this->getPersistedObjectsForClass($class);
        if (
            ! $this->checkIfObjectWasPersisted(
                $object,
                $arrayOfPersistedObjectsInClass
            )
        ) {
            return false;
        }
        $arrayOfPersistedObjectsInClass[] = $object;

        return true;
    }

    private function checkIfObjectWasPersisted(object $object, array $objectsArray): bool
    {
        foreach ($objectsArray as $value) {
            if ($value === $object) {
                return false;
            }
        }

        return true;
    }

    private function &getPersistedObjectsForClass(string $className): array
    {
        if (! isset($this->persisted[$className])) {
            $this->persisted[$className] = [];
        }

        return $this->persisted[$className];
    }

    private function getClassName($class): string
    {
        if (is_string($class)) {
            return $class;
        }
        if (is_object($class)) {
            return get_class($class);
        }
        throw new InvalidArgumentException("Invalid parameter given");
    }
}
