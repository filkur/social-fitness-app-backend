<?php

declare(strict_types=1);

namespace App\DataProvider\Activity;

use App\DataProvider\Utils\AllDataProvider;
use App\Entity\Activity\Activity;
use App\Repository\Activity\ActivityRepository;
use App\Utils\ApiPlatform\ApiPlatformCollectionFilter;
use App\Utils\ReadStorage\MutatorAfterReadStorage;
use Doctrine\ORM\QueryBuilder;

class ActivityDataProvider extends AllDataProvider
{
    private ActivityRepository $activityRepository;

    public function __construct(
        ApiPlatformCollectionFilter $apiPlatformCollectionFilter,
        MutatorAfterReadStorage $mutatorAfterReadStorage,
        ActivityRepository $activityRepository
    ) {
        parent::__construct($apiPlatformCollectionFilter, $mutatorAfterReadStorage);
        $this->activityRepository = $activityRepository;
    }

    protected function isValidResourceClass(string $resource): bool
    {
        return $resource === Activity::class;
    }

    protected function createDtoObject(object $object, array $context): object
    {
        return $object;
    }

    protected function findObject($id): ?object
    {
        return $this->activityRepository->find($id);
    }

    protected function getQueryBuilder(): QueryBuilder
    {
        return $this->activityRepository->createQueryBuilder('activity');
    }
}