<?php

declare(strict_types=1);

namespace App\DataProvider\Utils;

use App\Utils\ReadStorage\MutatorAfterReadStorage;
use App\Utils\DataHelper\MethodHelper;
use Symfony\Component\Uid\Ulid;

abstract class ItemMutatorProvider extends ItemProvider
{
    protected MutatorAfterReadStorage $mutatorAfterReadStorage;

    public function __construct(
        MutatorAfterReadStorage $mutatorAfterReadStorage
    ) {
        $this->mutatorAfterReadStorage = $mutatorAfterReadStorage;
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        if (! Ulid::isValid($id)) {
            return null;
        }

        $object = $this->findObject($id);
        if ($object === null) {
            return null;
        }
        $this->mutatorAfterReadStorage->setObject($object);

        return $this->createDtoObject($object, $context);
    }

    abstract protected function createDtoObject(object $object, array $context): object;

    protected function isValidMethod(array $context): bool
    {
        return MethodHelper::isPut($context);
    }
}
