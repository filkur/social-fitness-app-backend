<?php

declare(strict_types=1);

namespace App\DTO\Post\Input;

use App\Entity\Post\Post;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\PropertySetted\IsIdSet;
use App\Entity\Group\Group;
use App\Validator\Post\IsLoggedPostOrGroupOwner as IsLoggedPostOrGroupOwnerAssert;

/**
 * @IsLoggedPostOrGroupOwnerAssert(
 *     groups={"post:update"}
 * )
 */
class PostInput
{
    /**
     * @Groups({"post:patch"})
     * @Assert\NotBlank(
     *     groups={"post:update"}
     * )
     * @Assert\Type(
     *     groups={"post:update"},
     *     type="string"
     *
     * )
     */
    public string $id;

    /**
     * @Groups({"post:post"})
     * @IsIdSet(
     *     groups={"post:create"},
     *     targetEntity=Group::class
     * )
     */
    public string $groupId;

    /**
     * @Groups({"post:post", "post:patch"})
     * @Assert\NotBlank(
     *     groups={"post:create",  "post:update"}
     * )
     * @Assert\Type(
     *     groups={"post:create", "post:update"},
     *     type="string"
     * )
     * @Assert\Length(
     *     groups={"post:create", "post:update"},
     *     max=40
     * )
     */
    public string $content;

    public static function createFromEntity(Post $object)
    {
        $self = new self();

        $self->id = $object->getIdString();
        $self->content = $object->getContent();
        $self->groupId = $object->getGroup()
                                ->getIdString();

        return $self;
    }
}