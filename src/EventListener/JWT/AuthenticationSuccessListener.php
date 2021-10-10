<?php

declare(strict_types=1);

namespace App\EventListener\JWT;

use App\Entity\User\User;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;

class AuthenticationSuccessListener
{
    /**
     * @param AuthenticationSuccessEvent $event
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();
        $user = $event->getUser();

        if (!$user instanceof User) {
            return;
        }

        $data['id'] = $user->getIdString();
        $data['email'] = $user->getEmail();
        $data['nickname'] = $user->getNickname();

        $event->setData($data);
    }
}