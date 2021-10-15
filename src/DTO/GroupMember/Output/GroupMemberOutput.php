<?php

declare(strict_types=1);

namespace App\DTO\GroupMember\Output;

use App\DTO\User\Output\UserOutput;

class GroupMemberOutput
{
    public string $id;

    public UserOutput $user;

    public string $assignedAt;
}