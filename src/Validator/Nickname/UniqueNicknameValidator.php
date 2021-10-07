<?php

declare(strict_types=1);

namespace App\Validator\Nickname;

use App\Repository\User\UserRepository;
use App\Utils\User\UserGetter;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueNicknameValidator extends ConstraintValidator
{
    private UserRepository $userRepository;

    private UserGetter $userGetter;

    private TokenStorageInterface $tokenStorage;

    public function __construct(
        UserRepository $userRepository,
        UserGetter $userGetter,
        TokenStorageInterface $tokenStorage
    ) {
        $this->userRepository = $userRepository;
        $this->userGetter = $userGetter;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param string         $value
     * @param UniqueNickname $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        if ($this->tokenStorage->getToken())
        {
            $loggedUser = $this->userGetter->get();
            if ($loggedUser->getNickname() === $value) {
                return;
            }
        }

        $user = $this->userRepository->findOneBy([
            'nickname' => $value,
        ]);

        if ($user === null) {
            return;
        }

        $this->context->addViolation($constraint->message);
    }
}