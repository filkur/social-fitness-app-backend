<?php

declare(strict_types=1);

namespace App\Factory\Event;

use App\Entity\Event\Event;
use App\Entity\Group\Group;

class EventFactory
{
    public static function createFromParams(
        Group $group,
        string $name,
        string $description,
        int $pointGoal,
        int $pointPerRep,
        int $pointPerMinute,
        string $startDate,
        string $endDate,
        string $eventType
    ): Event {
        return Event::create(
            $group,
            $name,
            $description,
            $pointGoal,
            $pointPerRep,
            $pointPerMinute,
            $startDate,
            $endDate,
            $eventType
        );
    }
}