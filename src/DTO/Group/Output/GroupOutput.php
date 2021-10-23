<?php

declare(strict_types=1);

namespace App\DTO\Group\Output;

use App\DTO\Invitation\Output\InvitationOutput;
use App\DTO\User\Output\UserOutput;
use Symfony\Component\Serializer\Annotation\Groups;

class GroupOutput
{
    /**
     * @Groups({"group:collection", "group:item" })
     */
    public string $id;

    /**
     * @Groups({"group:collection", "group:item"})
     */
    public string $name;

    /**
     * @Groups({"group:collection", "group:item"})
     */
    public string $description;

    /**
     * @Groups({"group:collection", "group:item"})
     */
    public UserOutput $owner;

    /**
     * @Groups({"group:collection", "group:item"})
     */
    public ?array $groupMembers;

    /**
     * @Groups({"group:collection", "group:item"})
     */
    public ?InvitationOutput $invitation = null;

    /**
     * @Groups({"group:item", })
     */
    public ?array $posts;

    /**
     * @Groups({"group:item", })
     */
    public ?array $events;

    /**
     * @Groups({"group:collection", "group:item"})
     */
    public string $createdAt;

    /**
     * @Groups({"group:collection", "group:item"})
     */
    public string $updatedAt;
}