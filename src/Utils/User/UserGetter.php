<?php

declare(strict_types=1);

namespace App\Utils\User;

use App\Entity\User\User;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserGetter
{
    private TokenStorageInterface $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function get(): User
    {
        $token = $this->tokenStorage->getToken();

        if ($token === null) {
            throw new \InvalidArgumentException('Token is null');
        }

        $user = $token->getUser();

        if (!$user instanceof User) {
            throw new \InvalidArgumentException('User is not logged');
        }

        return $user;
    }
}
