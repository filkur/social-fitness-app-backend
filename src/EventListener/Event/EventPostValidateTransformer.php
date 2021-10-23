<?php

declare(strict_types=1);

namespace App\EventListener\Event;

use App\DTO\Event\Input\EventInput;
use App\Entity\Group\Group;
use App\EventListener\AbstractValidateTransformer;
use App\Factory\Event\EventFactory;
use App\Repository\Group\GroupRepository;
use App\Utils\DataHelper\MethodHelper;
use App\Utils\ReadStorage\MutatorAfterReadStorage;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class EventPostValidateTransformer extends AbstractValidateTransformer
{
    private GroupRepository $groupRepository;

    public function __construct(
        MutatorAfterReadStorage $mutatorAfterReadStorage,
        ContainerInterface $container,
        GroupRepository $groupRepository
    ) {
        parent::__construct($mutatorAfterReadStorage, $container);
        $this->groupRepository = $groupRepository;
    }

    protected function validPayload(object $payload): bool
    {
        return $payload instanceof EventInput;
    }

    protected function validRequest(Request $request): bool
    {
        return MethodHelper::isRequestPost($request);
    }

    /**
     * @param EventInput $payload
     */
    protected function transform(object $payload): object
    {
        /** @var Group $group */
        $group = $this->groupRepository->find($payload->groupId);

        return EventFactory::createFromParams(
            $group,
            $payload->name,
            $payload->description,
            $payload->pointGoal,
            $payload->pointPerRep,
            $payload->pointPerMinute,
            $payload->startDate,
            $payload->endDate,
            $payload->eventType,
        );
    }
}