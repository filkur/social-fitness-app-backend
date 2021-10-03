<?php

declare(strict_types=1);

namespace App\Validator\Password;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class IsPasswordCorrect extends Constraint
{
    public string $message = "Incorrect password";
}