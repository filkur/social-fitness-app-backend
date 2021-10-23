<?php

declare(strict_types=1);

namespace App\ Factory\Activity;

use App\Entity\Activity\Activity;
use App\Entity\Event\Event;
use App\Entity\EventMember\EventMember;

class ActivityFactory
{
    public static function createFromParams(
        string $name,
        int $value,
        EventMember $eventMember,
        Event $event
    ): Activity {
        return Activity::create(
            $name,
            $value,
            $eventMember,
            $event
        );
    }
}