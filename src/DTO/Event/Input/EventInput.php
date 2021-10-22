<?php

declare(strict_types=1);

namespace App\DTO\Event\Input;

use App\Entity\Event\Event;
use App\Utils\Date\DateHelper;

class EventInput
{
    public string $id;

    public string $groupId;

    public string $name;

    public string $description;

    public int $pointGoal = 0;

    public int $pointPerRep = 0;

    public int $pointPerMinute = 0;

    public string $startDate;

    public string $endDate;

    public string $eventType;

    public static function createFromEntity(Event $object)
    {
        $self = new self();

        $self->id = $object->getIdString();
        $self->groupId = $object->getGroup()
                                ->getIdString();
        $self->name = $object->getName();
        $self->description = $object->getDescription();
        $self->pointGoal = $object->getPointGoal();
        $self->pointPerRep = $object->getPointsPerRep();
        $self->pointPerMinute = $object->getPointsPerRep();
        $self->startDate = DateHelper::toDateFormat(
            $object->getStartDate()
        );
        $self->endDate = DateHelper::toDateFormat(
            $object->getEndDate()
        );
        $self->eventType = $object->getEventType();

        return $self;
    }
}