<?php

declare(strict_types=1);

namespace App\Validator\Email;

use App\Repository\User\UserRepository;
use App\Utils\User\UserGetter;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueEmailValidator extends ConstraintValidator
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
     * @param string      $value
     * @param UniqueEmail $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        $loggedUser = $this->userGetter->get();
        if ($loggedUser->getEmail() === $value) {
            return;
        }

        $user = $this->userRepository->findOneBy([
            'email' => $value,
        ]);

        if ($user === null) {
            return;
        }

        $this->context->addViolation($constraint->message);
    }
}