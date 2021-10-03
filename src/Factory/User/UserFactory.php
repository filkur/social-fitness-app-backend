<?php

declare(strict_types=1);

namespace App\Factory\User;

use App\DTO\User\Input\UserInput;
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

    public static function createFromUserInput(
        UserInput $userInput
    ): User {
        return self::createFromParams(
            $userInput->email,
            $userInput->nickname,
            $userInput->password
        );
    }
}