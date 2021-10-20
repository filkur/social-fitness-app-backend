<?php

declare(strict_types=1);

namespace App\DataProvider\Group;

use App\DataProvider\Utils\AllDataProvider;
use App\DTO\Group\Input\GroupInput;
use App\Entity\Group\Group;
use App\Repository\Group\GroupRepository;
use App\Utils\ApiPlatform\ApiPlatformCollectionFilter;
use App\Utils\ReadStorage\MutatorAfterReadStorage;
use Doctrine\ORM\QueryBuilder;

class GroupDataProvider extends AllDataProvider
{
    private GroupRepository $groupRepository;

    public function __construct(
        ApiPlatformCollectionFilter $apiPlatformCollectionFilter,
        MutatorAfterReadStorage $mutatorAfterReadStorage,
        GroupRepository $groupRepository
    )
    {
        parent::__construct($apiPlatformCollectionFilter, $mutatorAfterReadStorage);
        $this->groupRepository = $groupRepository;
    }

    protected function isValidResourceClass(string $resource): bool
    {
        return $resource === Group::class || $resource === GroupInput::class;
    }

    /**
     * @param Group $object
     */
    protected function createDtoObject(object $object, array $context): object
    {
        return GroupInput::createFromEntity($object);
    }

    protected function findObject($id): ?object
    {
        return $this->groupRepository->find($id);
    }

    protected function getQueryBuilder(): QueryBuilder
    {
        return $this->groupRepository->createQueryBuilder('groups');
    }
}