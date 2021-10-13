<?php

declare(strict_types=1);

namespace App\Validator\PropertySetted;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Uid\Ulid;

class EntityFinder
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    public function find(string $property, $propertyValue, string $entity, bool $isULID = false): bool
    {
        if ($isULID) {
            return $this->findByULID($entity, $propertyValue);
        }

        return 0 < $this->entityManager
                ->createQueryBuilder()
                ->select('COUNT(1)')
                ->from($entity, 'e')
                ->where('e.' . $property . ' = :propertyValue')
                ->setParameter('propertyValue', $propertyValue)
                ->getQuery()
                ->getSingleScalarResult();
    }

    private function findByULID(string $entity, string $ULID): bool
    {
        if (! Ulid::isValid($ULID)) {
            return false;
        }

        return $this->entityManager->getRepository($entity)
                                   ->find($ULID) !== null;
    }
}
