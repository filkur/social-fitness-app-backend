<?php

declare(strict_types=1);

namespace App\DTO\User\Input;

class UserInput
{
    public ?string $nickname;

    public ?string $email;

    public ?string $password;
}