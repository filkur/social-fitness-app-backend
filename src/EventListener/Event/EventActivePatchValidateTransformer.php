<?php

declare(strict_types=1);

namespace App\EventListener\Event;

use App\DTO\Event\Input\EventActiveInput;
use App\Entity\Event\Event;
use App\EventListener\AbstractValidateTransformer;
use App\Utils\DataHelper\MethodHelper;
use Symfony\Component\HttpFoundation\Request;

class EventActivePatchValidateTransformer extends AbstractValidateTransformer
{
    protected function validPayload(object $payload): bool
    {
        return $payload instanceof EventActiveInput;
    }

    protected function validRequest(Request $request): bool
    {
        return MethodHelper::isRequestPatch($request);
    }

    /**
     * @param EventActiveInput $payload
     */
    protected function transform(object $payload): object
    {
        /** @var Event $event */
        $event = $this->mutatorAfterReadStorage->getObject();

        $event->setIsActive($payload->isActive);

        return $event;
    }
}