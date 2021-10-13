<?php

declare(strict_types=1);

namespace App\DTO\Group\Input;

use App\Entity\Group\Group;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Group\GroupOwner as OwnerAssert;

class GroupInput
{
    /**
     * @Groups({"group:patch"})
     * @OwnerAssert()
     */
    public ?string $id = null;

    /**
     * @Groups({"group:post", "group:patch"})
     * @Assert\NotBlank()
     * @Assert\Length(
     *     max=50
     * )
     * @Assert\Type(
     *     type="string"
     * )
     */
    public ?string $name = null;

    /**
     * @Groups({"group:post", "group:patch"})
     * @Assert\NotBlank()
     * @Assert\Length(
     *     max=50
     * )
     * @Assert\Type(
     *     type="string"
     * )
     */
    public ?string $description = null;

    public static function createFromEntity(
        Group $group
    ): self {
        $self = new self();

        $self->id = $group->getIdString();
        $self->name = $group->getName();
        $self->description = $group->getDescription();

        return $self;
    }
}