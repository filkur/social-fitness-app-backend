<?php

declare(strict_types=1);

namespace App\ Factory\Invitation;

use App\Entity\Group\Group;
use App\Entity\Invitation\Invitation;

class InvitationFactory
{
    public static function createFromParams(
        Group $group,
        string $code
    ): Invitation {
        return Invitation::create(
            $group,
            $code
        );
    }
}