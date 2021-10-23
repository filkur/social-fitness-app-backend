<?php

declare(strict_types=1);

namespace App\DTO\EventMember\Output;

use App\DTO\User\Output\UserOutput;
use Symfony\Component\Serializer\Annotation\Groups;

class EventMemberOutput
{
    /**
     * @Groups({"eventMember:base"})
     */
    public UserOutput $user;

    /**
     * @Groups({"eventMember:base"})
     */
    public ?array $activities;
}