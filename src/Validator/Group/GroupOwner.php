<?php

declare(strict_types=1);

namespace App\Validator\Group;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation()
 */
class GroupOwner extends Constraint
{
    public string $message = "Logged user is not owner of this group";
}