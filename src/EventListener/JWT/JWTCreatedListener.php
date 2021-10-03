<?php

declare(strict_types=1);

namespace App\EventListener\JWT;

use App\Entity\User\User;
use App\Repository\User\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use InvalidArgumentException;


class JWTCreatedListener
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function onJWTCreated(JWTCreatedEvent $jwtCreatedEvent): void
    {
        $payload = $jwtCreatedEvent->getData();
        $user = $jwtCreatedEvent->getUser();

        if (! $user instanceof User) {
            $user = $this->userRepository->findOneByEmail($user->getUserIdentifier());
        }

        if ($user === null) {
            throw new InvalidArgumentException("User not found");
        }

        $payload['userId'] = $user->getIdString();
        $payload['userNickname'] = $user->getNickname();
        $jwtCreatedEvent->setData($payload);
    }

}