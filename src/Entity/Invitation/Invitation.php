<?php

declare(strict_types=1);

namespace App\Entity\Invitation;

use App\Entity\Group\Group;
use App\Entity\Traits\Timestamp\Timestamp;
use App\Entity\Traits\Timestamp\TimestampInterface;
use App\Entity\Traits\UlidTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\Invitation\InvitationRepository;

/**
 * @ORM\Table(
 *     name="invitation"
 * )
 * @ORM\Entity(
 *     repositoryClass=InvitationRepository::class
 * )
 */
class Invitation implements TimestampInterface
{
    use UlidTrait;
    use Timestamp;

    /**
     * @ORM\Column(
     *    type="string",
     *     length=8
     * )
     */
    private ?string $code = null;

    /**
     * @ORM\OneToOne(
     *     targetEntity=Group::class,
     *     inversedBy="invitation"
     * )
     */
    private ?Group $group = null;

    public static function create(
        Group $group,
        string $code
    ): self {
        $self = new self();

        $self->setCode($code);
        $self->setGroup($group);

        $group->addInvitation($self);

        return $self;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getGroup(): ?Group
    {
        return $this->group;
    }

    public function setGroup(?Group $group): void
    {
        $this->group = $group;
    }
}
