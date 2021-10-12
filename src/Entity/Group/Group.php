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
     *      mappedBy="group"
     * )
     */
    private Collection $groupMembers;

    /**
     * @ORM\OneToOne(
     *     targetEntity=Invitation::class,
     *     mappedBy="invitation"
     * )
     */
    private ?Invitation $invitation = null;

    public function __construct()
    {
        $this->groupMembers = new ArrayCollection();
    }
}