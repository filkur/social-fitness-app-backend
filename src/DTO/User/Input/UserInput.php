<?php

declare(strict_types=1);

namespace App\DTO\User\Input;

use App\Entity\User\User;

class UserInput
{
    public ?string $id = null;

    public ?string $nickname = null;

    public ?string $email = null;

    public ?string $password = null;


    public static function createFromEntity(User $user):  self
    {
        $self = new self();

        $self->id = $user->getIdString();
        $self->email = $user->getEmail();
        $self->nickname = $user->getNickname();
        $self->password = $user->getPassword();

        return $self;
    }
}