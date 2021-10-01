<?php

declare(strict_types=1);

namespace App\DTO\User\Input;

use App\Entity\User\User;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Password\IsPasswordCorrect as isPasswordCorrectAssert;

/**
 * @UniqueEntity(
 *     fields="nickname",
 *     message="User with this nickname exists",
 *     groups={"user:post", "user:update"}
 * )
 * @UniqueEntity(
 *     fields="email",
 *     message="User with this email exists",
 *     groups={"user:post", "user:update"}
 * )
 */
class UserInput
{
    /**
     * @Groups({"user:put", "user:patch"})
     * @Assert\NotBlank(
     *     groups={"user:update", "user:updatePassword"}
     * )
     * @Assert\Type(
     *     type="string"
     * )
     */
    public ?string $id = null;

    /**
     * @Groups({"user:post", "user:put"})
     * @Assert\Length(
     *     max=50,
     *     groups={"user:create", "user:update"}
     * )
     * @Assert\NotBlank(
     *     groups={"user:create", "user:update"}
     * )
     * @Assert\Type(
     *     type="string"
     * )
     */
    public ?string $nickname = null;

    /**
     * @Groups({"user:post", "user:put"})
     * @Assert\Email(
     *     groups={"user:create", "user:update"}
     * )
     */
    public ?string $email = null;

    /**
     * @Groups({"user:post","user:put", "user:patch"})
     * @isPasswordCorrectAssert(
     *      groups={"user:update"}
     * )
     * @Assert\NotBlank(
     *     groups={"user:create", "user:update", "user:updatePassword"}
     * )
     * @Assert\Length(
     *     groups={"user:create", "user:update", "user:updatePassword"},
     *     max=50
     * )
     * @Assert\Type(
     *     groups={"user:create", "user:update", "user:updatePassword"},
     *     type="string"
     * )
     */
    public ?string $password = null;

    /**
     * @Groups({"user:patch"})
     * @isPasswordCorrectAssert(
     *     groups={"user:updatePassword"}
     * )
     * @Assert\NotBlank(
     *     groups={"user:updatePassword"}
     * )
     * @Assert\Length(
     *     groups={"user:updatePassword"},
     *     max=50
     * )
     * @Assert\Type(
     *     groups={"user:create", "user:update", "user:updatePassword"},
     *     type="string"
     * )
     */
    public ?string $oldPassword = null;

    public static function createFromEntity(User $user):  self
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