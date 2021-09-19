<?php

declare(strict_types=1);

namespace Factory\User;

use App\Entity\User\User;

class UserFactory
{
    public static function createFromParams(
        string $email,
        string $nickname,
        string $password
    ): User {
        return User::create(
            $email,
            $nickname,
            $password
        );
    }
}