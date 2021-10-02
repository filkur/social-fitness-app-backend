<?php

declare(strict_types=1);

namespace App\DTO\User\Input;

use App\Entity\User\User;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Password\IsPasswordCorrect as isPasswordCorrectAssert;
use App\Validator\Email\UniqueEmail as UniqueEmailValidator;
use App\Validator\Nickname\UniqueNickname as UniqueNicknameValidator;

class UserInput
{
    /**
     * @Groups({"user:put", "user:patch"})
     */
    public ?string $id = null;

    /**
     * @Groups({"user:post", "user:put"})
     * @UniqueNicknameValidator(
     *     groups= {"user:create", "user:update"}
     * )
     */
    public ?string $nickname = null;

    /**
     * @Groups({"user:post", "user:put"})
     * @UniqueEmailValidator(
     *     groups= {"user:create", "user:update"}
     * )
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

    public static function createFromEntity(User $user): self
    {
        $self = new self();

        $self->id = $user->getIdString();
        $self->email = $user->getEmail();
        $self->nickname = $user->getNickname();
        $self->password = $user->getPassword();
        $self->oldPassword = $user->getPassword();

        return $self;
    }
}