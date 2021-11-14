<?php

declare(strict_types=1);

namespace App\DTO\Comment\Input;

use App\Entity\Comment\Comment;
use App\Validator\PropertySetted\IsIdSet;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Post\Post;
use App\Validator\Comment\IsLoggedCommentCreator as creatorAssert;

/**
 * @creatorAssert(
 *     groups={"comment:update"}
 * )
 */
class CommentInput
{
    /**
     * @Groups({"comment:patch"})
     * @Assert\NotBlank(
     *     groups={"comment:update"}
     * )
     * @Assert\Type(
     *     groups={"comment:update"},
     *     type="string"
     *
     * )
     */
    public ?string $id = null;

    /**
     * @Groups({"comment:post"})
     * @IsIdSet(
     *     groups={"comment:create"},
     *     targetEntity=Post::class
     * )
     */
    public string $postId;

    /**
     * @Groups({"comment:post", "comment:patch"})
     * @Assert\NotBlank(
     *     groups={"comment:create",  "comment:update"}
     * )
     * @Assert\Type(
     *     groups={"comment:create", "comment:update"},
     *     type="string"
     * )
     * @Assert\Length(
     *     groups={"comment:create", "comment:update"},
     *     max=300
     * )
     */
    public string $content;

    public static function createFromEntity(Comment $object): self
    {
        $self = new self();

        $self->id = $object->getIdString();
        $self->content = $object->getContent();
        $self->postId = $object->getPost()
                               ->getIdString();

        return $self;
    }
}