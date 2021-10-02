<?php

declare(strict_types=1);

namespace App\ Validator\Nickname;

use App\Repository\User\UserRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueNicknameValidator extends ConstraintValidator
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param string      $value
     * @param UniqueNickname $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        $user = $this->userRepository->findOneBy([
            'nickname' => $value,
        ]);

        if ($user === null) {
            return;
        }

        $this->context->addViolation($constraint->message);
    }
}