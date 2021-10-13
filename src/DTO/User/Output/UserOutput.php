<?php

declare(strict_types=1);

namespace App\DTO\User\Output;

use App\Entity\User\User;

class UserOutput
{
    public ?string $id;

    public ?string $nickname;

    public ?string $email;

    public static function createFromUser(
        User $user
    ): self {
        $output = new self();

        $output->id = $user->getIdString();
        $output->nickname = $user->getNickname();
        $output->email = $user->getEmail();

        return $output;
    }
}