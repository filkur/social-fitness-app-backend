<?php

declare(strict_types=1);

namespace App\Validator\Password;

use App\Utils\User\UserGetter;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsPasswordCorrectValidator extends ConstraintValidator
{
    private UserGetter $userGetter;

    private PasswordHasherFactoryInterface $passwordHasherFactory;

    public function __construct(
        UserGetter $userGetter,
        PasswordHasherFactoryInterface $passwordHasherFactory
    ) {
        $this->userGetter = $userGetter;
        $this->passwordHasherFactory = $passwordHasherFactory;
    }

    /**
     * @param string            $value
     * @param IsPasswordCorrect $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        $user = $this->userGetter->get();
        $userPassword = $user->getPassword();

        $checkPasswordResult = ($this->passwordHasherFactory->getPasswordHasher($user)
                                                            ->verify($userPassword, $value));

        if ($checkPasswordResult) {
            return;
        }

        $this->context->addViolation($constraint->message);
    }
}