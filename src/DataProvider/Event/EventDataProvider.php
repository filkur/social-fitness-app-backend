<?php

declare(strict_types=1);

namespace App\DataProvider\Event;

use App\DataProvider\Utils\AllDataProvider;
use App\DTO\Event\Input\EventActiveInput;
use App\DTO\Event\Input\EventInput;
use App\Entity\Event\Event;
use App\Repository\Event\EventRepository;
use App\Utils\ApiPlatform\ApiPlatformCollectionFilter;
use App\Utils\ReadStorage\MutatorAfterReadStorage;
use Doctrine\ORM\QueryBuilder;

class EventDataProvider extends AllDataProvider
{
    private EventRepository $eventRepository;

    public function __construct(
        ApiPlatformCollectionFilter $apiPlatformCollectionFilter,
        MutatorAfterReadStorage $mutatorAfterReadStorage,
        EventRepository $eventRepository
    ) {
        parent::__construct($apiPlatformCollectionFilter,$mutatorAfterReadStorage);

        $this->eventRepository = $eventRepository;
    }

    protected function isValidResourceClass(string $resource): bool
    {
        return $resource === EventInput::class || $resource ===EventActiveInput::class || $resource === Event::class;
    }

    /**
     * @param Event $object
     */
    protected function createDtoObject(object $object, array $context): object
    {
        return EventInput::createFromEntity($object);
    }

    protected function findObject($id): ?object
    {
        return $this->eventRepository->find($id);
    }

    protected function getQueryBuilder(): QueryBuilder
    {
        return $this->eventRepository->createQueryBuilder('event');
    }
}