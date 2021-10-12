<?php

declare(strict_types=1);

namespace App\Entity\Invitation;

use App\Entity\Group\Group;
use App\Entity\Traits\Timestamp\Timestamp;
use App\Entity\Traits\Timestamp\TimestampInterface;
use App\Entity\Traits\UlidTrait;
use Doctrine\ORM\Mapping as ORM;

/**
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
    private string $code;

    /**
     * @ORM\OneToOne(
     *     targetEntity=Group::class,
     *     inversedBy="invitation"
     * )
     */
    private Group $group;
}