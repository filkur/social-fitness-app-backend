<?php

declare(strict_types=1);

namespace App\Service\Password;

use App\DTO\User\Input\UserInput;
use App\Entity\User\User;
use App\Utils\User\UserGetter;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

class UpdatePasswordService
{
    private PasswordHasherFactoryInterface $passwordHasherFactory;

    public function __construct(
        PasswordHasherFactoryInterface $passwordHasherFactory
    ) {
        $this->passwordHasherFactory = $passwordHasherFactory;
    }

    public function update(User $user, UserInput $userInput): User
    {
        $newPassword = $this->passwordHasherFactory->getPasswordHasher($user)
                                                   ->hash($userInput->password);

        $user->setPassword($newPassword);

        return $user;
    }
}