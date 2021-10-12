<?php

declare(strict_types=1);

namespace App\Entity\GroupMember;

use App\Entity\Group\Group;
use App\Entity\Traits\UlidTrait;
use App\Entity\User\User;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\GroupMember\GroupMemberRepository;

/**
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
     *     inversedBy="groupMember"
     * )
     */
    private User $user;

    /**
     * @ORM\ManyToOne(
     *     targetEntity=Group::class,
     *     inversedBy="groupMembers"
     * )
     */
    private Group $group;

    /**
     * @ORM\Column(
     *     type="datetime_immutable"
     * )
     */
    private DateTimeImmutable $assignedAt;
}