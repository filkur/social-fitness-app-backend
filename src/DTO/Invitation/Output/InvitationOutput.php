<?php

declare(strict_types=1);

namespace App\DTO\Invitation\Output;

use App\Entity\Invitation\Invitation;

class InvitationOutput
{
    public ?string $id = null;

    public ?string $code = null;

    public static function createFromInvitation(
        Invitation $invitation
    ): self {
        $output = new self();

        $output->id = $invitation->getIdString();
        $output->code = $invitation->getCode();

        return $output;
    }
}