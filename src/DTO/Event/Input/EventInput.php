<?php

declare(strict_types=1);

namespace App\DTO\Event\Input;

use App\Entity\Event\Event;
use App\Utils\Date\DateHelper;
use Symfony\Component\Serializer\Annotation\Groups;

class EventInput
{
    /**
     * @Groups({"event:patch"})
     */
    public string $id;

    /**
     * @Groups({"event:post"})
     */
    public string $groupId;

    /**
     * @Groups({"event:post", "event:patch"})
     */
    public string $name;

    /**
     * @Groups({"event:post", "event:patch"})
     */
    public string $description;

    /**
     * @Groups({"event:post", "event:patch"})
     */
    public int $pointGoal = 0;

    /**
     * @Groups({"event:post", "event:patch"})
     */
    public int $pointPerRep = 0;

    /**
     * @Groups({"event:post", "event:patch"})
     */
    public int $pointPerMinute = 0;

    /**
     * @Groups({"event:post", "event:patch"})
     */
    public string $startDate;

    /**
     * @Groups({"event:post", "event:patch"})
     */
    public string $endDate;

    /**
     * @Groups({"event:post", "event:patch"})
     */
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