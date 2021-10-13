<?php

declare(strict_types=1);

namespace App\DTO\Group\Output;

use App\DTO\Invitation\Output\InvitationOutput;
use App\DTO\User\Output\UserOutput;

class GroupOutput
{
    public string $id;

    public string $name;

    public string $description;

    public UserOutput $owner;

    public ?array $groupMembers;

    public ?InvitationOutput $invitation = null;
}