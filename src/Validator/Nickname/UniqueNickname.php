<?php

declare(strict_types=1);

namespace App\Validator\Nickname;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UniqueNickname extends Constraint
{
    public string $message = "User with nickname already exist ";
}