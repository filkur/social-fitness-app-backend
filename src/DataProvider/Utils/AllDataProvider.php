<?php

declare(strict_types=1);

namespace App\DataProvider\Utils;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use App\Utils\DataHelper\MethodHelper;
use App\Utils\ReadStorage\MutatorAfterReadStorage;
use App\Utils\ApiPlatform\ApiPlatformCollectionFilter;
use Doctrine\ORM\QueryBuilder;

/**
 * Class AllProvider - this class contain all methods required for basic CRUD operations
 */
abstract class AllDataProvider extends AbstractRestrictedProvider implements
    ItemDataProviderInterface,
    ContextAwareCollectionDataProviderInterface
{
    private ApiPlatformCollectionFilter $apiPlatformCollectionFilter;

    private MutatorAfterReadStorage $mutatorAfterReadStorage;

    public function __construct(
        ApiPlatformCollectionFilter $apiPlatformCollectionFilter,
        MutatorAfterReadStorage $mutatorAfterReadStorage
    ) {
        $this->apiPlatformCollectionFilter = $apiPlatformCollectionFilter;
        $this->mutatorAfterReadStorage = $mutatorAfterReadStorage;
    }

    protected function isValidMethod(array $context): bool
    {
        return true;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = [])
    {
        $queryBuilder = $this->getQueryBuilder();

        return $this->getFilteredDataCollection($queryBuilder, $resourceClass, $operationName, $context);
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        $object = $this->findObject($id);
        if ($object === null) {
            return null;
        }

        if (MethodHelper::isPut($context)) {
            $this->mutatorAfterReadStorage->setObject($object);

            return $this->createDtoObject($object, $context);
        }

        return $object;
    }

    abstract protected function createDtoObject(object $object, array $context): object;

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

    abstract protected function findObject($id): ?object;

    abstract protected function getQueryBuilder(): QueryBuilder;
}
