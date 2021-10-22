<?php

declare(strict_types=1);

namespace App\DTO\Invitation\Output;

use App\Entity\Invitation\Invitation;
use App\Utils\Date\DateHelper;
use Symfony\Component\Serializer\Annotation\Groups;

class InvitationOutput
{
    /**
     * @Groups({"invitation:base"})
     */
    public ?string $id = null;

    /**
     * @Groups({"invitation:base"})
     */
    public ?string $code = null;

    /**
     * @Groups({"invitation:base"})
     */
    public ?string $createdAt = null;

    /**
     * @Groups({"invitation:base"})
     */
    public ?string $updatedAt = null;

    public static function createFromInvitation(
        Invitation $invitation
    ): self {
        $output = new self();

        $output->id = $invitation->getIdString();
        $output->code = $invitation->getCode();
        $output->createdAt = DateHelper::toDateTimeFormat(
            $invitation->getCreatedAt()
        );
        $output->updatedAt = DateHelper::toDateTimeFormat(
            $invitation->getUpdatedAt()
        );

        return $output;
    }
}