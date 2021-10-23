<?php

declare(strict_types=1);

namespace App\EventListener\Event;

use App\DTO\Event\Input\EventInput;
use App\Entity\Event\Event;
use App\EventListener\AbstractValidateTransformer;
use App\Utils\DataHelper\MethodHelper;
use App\Utils\Date\DateHelper;
use Symfony\Component\HttpFoundation\Request;

class EventPatchValidateTransformer extends AbstractValidateTransformer
{
    protected function validPayload(object $payload): bool
    {
        return $payload instanceof EventInput;
    }

    protected function validRequest(Request $request): bool
    {
        return MethodHelper::isRequestPatch($request);
    }

    /**
     * @param EventInput $payload
     */
    protected function transform(object $payload): object
    {
        /** @var Event $event */
        $event = $this->mutatorAfterReadStorage->getObject();

        $event->update(
            $payload->name,
            $payload->description,
            $payload->pointGoal,
            $payload->pointPerRep,
            $payload->pointPerMinute,
            DateHelper::createDateFromString($payload->startDate),
            DateHelper::createDateFromString($payload->endDate),
        );

        return $event;
    }
}