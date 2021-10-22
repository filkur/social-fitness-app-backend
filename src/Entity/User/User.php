<?php

namespace App\Entity\User;

use App\Entity\Comment\Comment;
use App\Entity\Post\Post;
use App\Entity\Traits\Email;
use App\Entity\Traits\Timestamp\Timestamp;
use App\Entity\Traits\Timestamp\TimestampInterface;
use App\Entity\Traits\UlidTrait;
use App\Repository\User\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Group\Group;
use App\Entity\GroupMember\GroupMember;

/**
 * @ORM\Table(
 *      name = "users"
 * )
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface, TimestampInterface
{
    use UlidTrait;
    use Timestamp;
    use Email;

    public const ROLE_USER = "ROLE_USER";

    /**
     * @ORM\Column(
     *     type="string",
     *     length=50,
     *     unique=true
     * )
     */
    private ?string $nickname;

    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(
     *     targetEntity=Group::class,
     *     mappedBy="owner",
     *     orphanRemoval=true,
     *     cascade={"remove"}
     * )
     */
    private Collection $groups;

    /**
     * @ORM\OneToMany(
     *     targetEntity=GroupMember::class,
     *     mappedBy="user",
     *     orphanRemoval=true,
     *     cascade={"remove"}
     * )
     */
    private Collection $groupMembers;

    /**
     * @ORM\OneToMany(
     *     targetEntity=Post::class,
     *     mappedBy="owner",
     *     orphanRemoval=true,
     *     cascade={"persist", "remove"}
     * )
     */
    private Collection $posts;

    /**
     * @ORM\OneToMany(
     *     targetEntity=Comment::class,
     *     mappedBy="owner",
     *     orphanRemoval=true,
     *     cascade={"persist", "remove"}
     * )
     */
    private Collection $comments;

    public function __construct()
    {
        $this->groups = new ArrayCollection();
        $this->groupMembers = new ArrayCollection();
        $this->posts = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public static function create(
        string $email,
        string $nickname,
        string $password
    ): self {
        $self = new self();

        $self->setEmail($email);
        $self->setNickname($nickname);
        $self->setPassword($password);
        $self->setRoles((array)User::ROLE_USER);

        return $self;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(?string $nickname): void
    {
        if ($nickname === null) {
            return;
        }
        $this->nickname = $nickname;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string)$this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string)$this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        //  guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function update(
        ?string $nickname,
        ?string $email
    ): void {
        $this->setNickname($nickname);
        $this->setEmail($email);
    }

    public function updatePassword(string $password)
    {
        $this->password = $password;
    }

    public function addGroup(Group $group): void
    {
        $this->groups->add($group);
    }

    public function getGroups()
    {
        return $this->groups;
    }

    public function addGroupMember(GroupMember $groupMember): self
    {
        if (! $this->groupMembers->contains($groupMember)){
            $this->groupMembers->add($groupMember);
        }
        return $this;
    }

    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->setOwner($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getOwner() === $this) {
                $post->setOwner(null);
            }
        }

        return $this;
    }

    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setOwner($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getOwner() === $this) {
                $comment->setOwner(null);
            }
        }

        return $this;
    }
}
