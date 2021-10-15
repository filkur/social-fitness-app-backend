<?php

declare(strict_types=1);

namespace App\Factory\GroupMember;

use App\Entity\Group\Group;
use App\Entity\GroupMember\GroupMember;
use App\Entity\User\User;

class GroupMemberFactory
{
    public static function createFromParameters(
        User $user,
        Group $group
    ): GroupMember
    {
        return GroupMember::create(
            $user,
            $group
        );
    }
}