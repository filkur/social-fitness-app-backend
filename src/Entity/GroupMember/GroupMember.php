<?php

declare(strict_types=1);

namespace App\Entity\GroupMember;

use App\Entity\Group\Group;
use App\Entity\Traits\UlidTrait;
use App\Entity\User\User;
use App\Utils\Date\DateHelper;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\GroupMember\GroupMemberRepository;

/**
 * @ORM\Table(
 *     name="group_member"
 * )
 * @ORM\Entity(
 *     repositoryClass=GroupMemberRepository::class
 * )
 */
class GroupMember
{
    use UlidTrait;

    /**
     * @ORM\ManyToOne(
     *     targetEntity=User::class,
     *     inversedBy="groupMembers",
     *     cascade={"persist"}
     * )
     */
    private User $user;

    /**
     * /**
     * @ORM\ManyToOne(
     *     targetEntity=Group::class,
     *     inversedBy="groupMember",
     *     cascade={"persist"}
     * )
     * @ORM\JoinColumn(
     *     nullable=false
     * )
     */
    private Group $group;

    /**
     * @ORM\Column(
     *     type="datetime_immutable",
     *     name="assigned_at"
     * )
     */
    private DateTimeImmutable $assignedAt;

    /**
     * @param User  $user
     * @param Group $group
     */
    private function __construct(User $user, Group $group)
    {
        $this->user = $user;
        $this->group = $group;
        $this->setAssignedAt();
    }

    public static function create
    (
        User $user,
        Group $group
    ): self
    {
        $self = new self($user, $group);

        $user->addGroupMember($self);
        $group->addGroupMember($self);

        return $self;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getGroup(): Group
    {
        return $this->group;
    }

    public function setGroup(Group $group): void
    {
        $this->group = $group;
    }

    public function getAssignedAt(): DateTimeImmutable
    {
        return $this->assignedAt;
    }


    public function setAssignedAt(): void
    {
        $this->assignedAt = new DateTimeImmutable();
    }
}
