<?php

declare(strict_types=1);

namespace App\Validator\Email;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UniqueEmail extends Constraint
{
    public string $message = "User with email already exist ";
}