<?php

declare(strict_types=1);

namespace App\Validator\Invitation;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation()
 */
class isInvitationExist extends Constraint
{
    public string $message = "Invitation not found";
}