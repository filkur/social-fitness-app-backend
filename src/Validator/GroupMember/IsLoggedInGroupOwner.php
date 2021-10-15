<?php

declare(strict_types=1);

namespace App\Validator\GroupMember;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation()
 */
class IsLoggedInGroupOwner extends Constraint
{
    public string $message = "Group admin cannot be added as user";
}