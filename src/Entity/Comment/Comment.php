<?php

namespace App\Entity\Comment;

use App\Entity\Post\Post;
use App\Entity\Traits\Timestamp\Timestamp;
use App\Entity\Traits\Timestamp\TimestampInterface;
use App\Entity\Traits\UlidTrait;
use App\Entity\User\User;
use App\Repository\Comment\CommentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 */
class Comment implements TimestampInterface
{

    use UlidTrait;
    use Timestamp;

    /**
     * @ORM\Column(
     *     type="string",
     *     length=200
     * )
     */
    private string $content;

    /**
     * @ORM\ManyToOne(
     *     targetEntity=User::class,
     *     inversedBy="comments"
     * )
     * @ORM\JoinColumn(
     *     nullable=false
     * )
     */
    private User $owner;

    /**
     * @ORM\ManyToOne(
     *     targetEntity=Post::class,
     *     inversedBy="comments"
     * )
     * @ORM\JoinColumn(nullable=false)
     */
    private Post $post;

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): self
    {
        $this->post = $post;

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }
}

