<?php

declare(strict_types=1);

namespace App\Validator\GroupMember;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation()
 */
class IsUserMember extends Constraint
{
    public string $message = "You are a member of this group";
}