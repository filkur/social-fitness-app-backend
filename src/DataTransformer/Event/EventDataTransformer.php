<?php

declare(strict_types=1);

namespace App\DataTransformer\Event;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\DTO\Event\Output\EventOutput;
use App\Entity\Event\Event;
use App\Utils\Date\DateHelper;

class EventDataTransformer implements DataTransformerInterface
{
    /**
     * @param Event $object
     */
    public function transform($object, string $to, array $context = [])
    {
        $output = new EventOutput();

        $output->id = $object->getIdString();
        $output->name = $object->getName();
        $output->description = $object->getDescription();
        $output->pointGoal = $object->getPointGoal();
        $output->pointPerRep = $object->getPointsPerRep();
        $output->pointPerMinute = $object->getPointsPerMinute();
        $output->startDate = DateHelper::toDateFormat(
            $object->getStartDate()
        );
        $output->endDate = DateHelper::toDateFormat(
            $object->getEndDate()
        );
        $output->eventType = $object->getEventType();
        $output->eventMembers = $object->getEventMembers()
                                       ->toArray();

        return $output;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return $data === Event::class && $to === EventOutput::class;
    }
}