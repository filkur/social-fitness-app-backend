<?php

declare(strict_types=1);

namespace App\Factory\EventMember;

use App\Entity\Event\Event;
use App\Entity\EventMember\EventMember;
use App\Entity\User\User;

class EventMemberFactory
{
    public static function createFromParams(
        User $loggedUser,
        Event $event
    ): EventMember {
        return EventMember::create(
            $loggedUser,
            $event
        );
    }
}