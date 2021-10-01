<?php

declare(strict_types=1);

namespace App\DTO\User\Input;

use App\Entity\User\User;
use Symfony\Component\Serializer\Annotation\Groups;

class UserInput
{
    /**
     * @Groups({"user:put", "user:patch"})
     */
    public ?string $id = null;

    /**
     * @Groups({"user:post", "user:put"})
     */
    public ?string $nickname = null;

    /**
     * @Groups({"user:post", "user:put"})
     */
    public ?string $email = null;

    /**
     * @Groups({"user:post","user:put", "user:patch"})
     */
    public ?string $password = null;

    /**
     * @Groups({"user:patch"})
     */
    public ?string $oldPassword = null;

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