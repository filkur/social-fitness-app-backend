<?php

declare(strict_types=1);

namespace App\DataProvider\EventMember;

use App\DataProvider\Utils\AllDataProvider;
use App\Entity\EventMember\EventMember;
use App\Repository\EventMember\EventMemberRepository;
use App\Utils\ApiPlatform\ApiPlatformCollectionFilter;
use App\Utils\ReadStorage\MutatorAfterReadStorage;
use Doctrine\ORM\QueryBuilder;

class EventMemberDataProvider extends AllDataProvider
{
    private EventMemberRepository $eventMemberRepository;

    public function __construct(
        ApiPlatformCollectionFilter $apiPlatformCollectionFilter,
        MutatorAfterReadStorage $mutatorAfterReadStorage,
        EventMemberRepository $eventMemberRepository
    ) {
        parent::__construct($apiPlatformCollectionFilter, $mutatorAfterReadStorage);
        $this->eventMemberRepository = $eventMemberRepository;
    }

    protected function isValidResourceClass(string $resource): bool
    {
        return $resource === EventMember::class;
    }

    protected function createDtoObject(object $object, array $context): object
    {
        return $object;
    }

    protected function findObject($id): ?object
    {
        return $this->eventMemberRepository->find($id);
    }

    protected function getQueryBuilder(): QueryBuilder
    {
        return $this->eventMemberRepository->createQueryBuilder('event_member');
    }
}