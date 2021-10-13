<?php

declare(strict_types=1);

namespace App\Factory\Group;

use App\Entity\Group\Group;
use App\Entity\User\User;

class GroupFactory
{
    public static function createFromParams(
        User $owner,
        string $name,
        string $description
    ): Group
    {
        return Group::create(
            $owner,
            $name,
            $description
        );
    }
}