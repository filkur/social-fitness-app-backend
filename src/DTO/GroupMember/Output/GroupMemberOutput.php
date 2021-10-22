<?php

declare(strict_types=1);

namespace App\DTO\GroupMember\Output;

use App\DTO\User\Output\UserOutput;
use Symfony\Component\Serializer\Annotation\Groups;

class GroupMemberOutput
{
    /**
     * @Groups({"groupMember:base"})
     */
    public string $id;

    /**
     * @Groups({"groupMember:base"})
     */
    public UserOutput $user;

    /**
     * @Groups({"groupMember:base"})
     */
    public string $assignedAt;
}