<?php

namespace App\Entity\Post;

use App\Entity\Comment\Comment;
use App\Entity\Group\Group;
use App\Entity\Traits\Timestamp\Timestamp;
use App\Entity\Traits\Timestamp\TimestampInterface;
use App\Entity\Traits\UlidTrait;
use App\Entity\User\User;
use App\Repository\Post\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post implements TimestampInterface
{
    use UlidTrait;
    use Timestamp;

    /**
     * @ORM\Column(
     *     type="string",
     *     length=300
     * )
     */
    private ?string $content;

    /**
     * @ORM\ManyToOne(
     *     targetEntity=Group::class,
     *     inversedBy="posts"
     * )
     */
    private Group $group;

    /**
     * @ORM\ManyToOne(
     *     targetEntity=User::class,
     *     inversedBy="posts"
     * )
     * @ORM\JoinColumn(
     *     nullable=false
     * )
     */
    private User $owner;

    /**
     * @ORM\OneToMany(
     *     targetEntity=Comment::class,
     *     mappedBy="post", orphanRemoval=true,
     *     cascade={"persist", "remove"}
     *     )
     */
    private Collection $comments;

    private function __construct(
        User $user,
        Group $group,
        string $content
    ) {
        $this->setOwner($user);
        $this->setGroup($group);
        $this->setContent($content);
        $this->comments = new ArrayCollection();
    }

    public static function create(
        User $user,
        Group $group,
        string $content
    ): self {
        $self = new self(
            $user,
            $group,
            $content
        );
        $user->addPost($self);
        $group->addPost($self);

        return $self;
    }

    public function getGroup(): ?Group
    {
        return $this->group;
    }

    public function setGroup(?Group $group): self
    {
        $this->group = $group;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): void
    {
        $this->content = $content;
    }

    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (! $this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setPost($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getPost() === $this) {
                $comment->setPost(null);
            }
        }

        return $this;
    }
}

