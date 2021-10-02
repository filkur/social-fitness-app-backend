<?php

declare(strict_types=1);

namespace App\ Validator\Nickname;

use App\Repository\User\UserRepository;
use App\Utils\User\UserGetter;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueNicknameValidator extends ConstraintValidator
{
    private UserRepository $userRepository;

    private UserGetter $userGetter;

    public function __construct(
        UserRepository $userRepository,
        UserGetter $userGetter
    ) {
        $this->userRepository = $userRepository;
        $this->userGetter = $userGetter;
    }

    /**
     * @param string         $value
     * @param UniqueNickname $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        $loggedUser = $this->userGetter->get();
        if ($loggedUser->getNickname() === $value) {
            return;
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