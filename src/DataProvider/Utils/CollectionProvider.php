<?php

declare(strict_types=1);

namespace App\DataProvider\Utils;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use App\Utils\ApiPlatform\ApiPlatformCollectionFilter;
use Doctrine\ORM\QueryBuilder;

abstract class CollectionProvider extends AbstractRestrictedProvider implements
    ContextAwareCollectionDataProviderInterface
{
    private ApiPlatformCollectionFilter $apiPlatformCollectionFilter;

    public function __construct(
        ApiPlatformCollectionFilter $apiPlatformCollectionFilter
    ) {
        $this->apiPlatformCollectionFilter = $apiPlatformCollectionFilter;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = [])
    {
        $queryBuilder = $this->getQueryBuilder();

        return $this->getFilteredDataCollection($queryBuilder, $resourceClass, $operationName, $context);
    }

    abstract protected function getQueryBuilder(): QueryBuilder;

    private function getFilteredDataCollection(
        QueryBuilder $queryBuilder,
        string $resourceClass,
        string $operationName,
        array $context
    ): iterable {
        return $this->apiPlatformCollectionFilter->applyFilteredQuery(
            $queryBuilder,
            $resourceClass,
            $operationName,
            $context
        );
    }

    final protected function isValidMethod(array $context): bool
    {
        return true;
    }
}
