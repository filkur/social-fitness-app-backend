<?php

declare(strict_types=1);

namespace App\EventListener\Activity;

use App\DTO\Activity\Input\ActivityInput;
use App\Entity\Event\Event;
use App\Entity\User\User;
use App\EventListener\AbstractValidateTransformer;
use App\Factory\Activity\ActivityFactory;
use App\Factory\EventMember\EventMemberFactory;
use App\Repository\Event\EventRepository;
use App\Utils\DataHelper\MethodHelper;
use App\Utils\ReadStorage\MutatorAfterReadStorage;
use App\Utils\User\UserGetter;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class ActivityPostValidateTransformer extends AbstractValidateTransformer
{
    private UserGetter $userGetter;

    private EventRepository $eventRepository;

    public function __construct(
        MutatorAfterReadStorage $mutatorAfterReadStorage,
        ContainerInterface $container,
        UserGetter $userGetter,
        EventRepository $eventRepository
    ) {
        parent::__construct($mutatorAfterReadStorage, $container);
        $this->userGetter = $userGetter;
        $this->eventRepository = $eventRepository;
    }

    protected function validPayload(object $payload): bool
    {
        return $payload instanceof ActivityInput;
    }

    protected function validRequest(Request $request): bool
    {
        return MethodHelper::isRequestPost($request);
    }

    /**
     * @param ActivityInput $payload
     */
    protected function transform(object $payload): object
    {
        /** @var User $loggedUser */
        $loggedUser = $this->userGetter->get();

        /** @var Event $event */
        $event = $this->eventRepository->find($payload->eventId);

        $eventMember = EventMemberFactory::createFromParams(
            $loggedUser,
            $event
        );

        return ActivityFactory::createFromParams(
            $payload->name,
            $payload->value,
            $eventMember,
            $event
        );
    }
}