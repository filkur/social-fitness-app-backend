<?php

declare(strict_types=1);

namespace App\Entity\Group;

use App\Entity\Invitation\Invitation;
use App\Entity\Traits\Timestamp\Timestamp;
use App\Entity\Traits\Timestamp\TimestampInterface;
use App\Entity\Traits\UlidTrait;
use App\Entity\User\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\Group\GroupRepository;
use App\Entity\GroupMember\GroupMember;

/**
 * @ORM\Table(
 *     name="groups"
 * )
 * @ORM\Entity(
 *     repositoryClass=GroupRepository::class
 * )
 */
class Group implements TimestampInterface
{
    use UlidTrait;
    use Timestamp;

    /**
     * @ORM\Column(
     *      type="string",
     *      length=50
     * )
     */
    private string $name;

    /**
     * @ORM\Column(
     *      type="string",
     *      length=200
     * )
     */
    private string $description;

    /**
     * @ORM\ManyToOne(
     *     targetEntity=User::class,
     *     inversedBy="groups"
     * )
     */
    private User $owner;

    /**
     * @ORM\OneToMany(
     *     targetEntity=GroupMember::class,
     *     mappedBy="group",
     *     orphanRemoval=true,
     *     cascade={"remove"}
     * )
     */
    private Collection $groupMembers;

    /**
     * @ORM\OneToOne(
     *     targetEntity=Invitation::class,
     *     mappedBy="group",
     *     cascade={"remove"}
     * )
     */
    private ?Invitation $invitation = null;

    public function __construct()
    {
        $this->groupMembers = new ArrayCollection();
    }

    public static function create(
        User $owner,
        string $name,
        string $description
    ): self {
        $self = new self();

        $self->setOwner($owner);
        $self->setDescription($description);
        $self->setName($name);

        $owner->addGroup($self);

        return $self;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getOwner(): User
    {
        return $this->owner;
    }

    public function getGroupMembers(): Collection
    {
        return $this->groupMembers;
    }

    public function getGroupMembersArray(): array
    {
        return $this->groupMembers->toArray();
    }

    public function getInvitation(): ?Invitation
    {
        return $this->invitation;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setOwner(User $owner): void
    {
        $this->owner = $owner;
    }

    public function addInvitation(Invitation $invitation): void
    {
        $this->invitation = $invitation;
    }

    public function addGroupMember(GroupMember $groupMember): Group
    {
        if (! $this->groupMembers->contains($groupMember)) {
            $this->groupMembers->add($groupMember);
        }

        return $this;
    }
}
