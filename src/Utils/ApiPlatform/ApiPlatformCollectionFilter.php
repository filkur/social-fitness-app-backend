<?php

declare(strict_types=1);

namespace App\Utils\ApiPlatform;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\ContextAwareQueryResultCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGenerator;
use Doctrine\ORM\QueryBuilder;

class ApiPlatformCollectionFilter
{
    private iterable $collectionExtensions;

    public function __construct(
        iterable $collectionExtensions = []
    ) {
        $this->collectionExtensions = $collectionExtensions;
    }

    public function applyFilteredQuery(
        QueryBuilder $queryBuilder,
        string $resourceClass,
        string $operationName,
        array $context
    ): iterable {
        foreach ($this->collectionExtensions as $extension) {
            $extension->applyToCollection(
                $queryBuilder,
                new QueryNameGenerator(),
                $resourceClass,
                $operationName,
                $context
            );
            if (
                $extension instanceof ContextAwareQueryResultCollectionExtensionInterface
                && $extension->supportsResult($resourceClass, $operationName, $context)
            ) {
                return $extension->getResult($queryBuilder, $resourceClass, $operationName, $context);
            }
        }

        return $queryBuilder->getQuery()
                            ->execute();
    }
}
