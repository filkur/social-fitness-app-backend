<?php

declare(strict_types=1);

namespace App\Validator\Group;

use App\Entity\User\User;
use App\Repository\Group\GroupRepository;
use App\Utils\User\UserGetter;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class GroupOwnerValidator extends ConstraintValidator
{
    private UserGetter $userGetter;

    private GroupRepository $groupRepository;

    public function __construct(
        UserGetter $userGetter,
        GroupRepository $groupRepository
    ) {
        $this->userGetter = $userGetter;
        $this->groupRepository = $groupRepository;
    }

    /**
     * @param string     $value
     * @param GroupOwner $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        /** @var User $user */
        $user = $this->userGetter->get();
        $group = $this->groupRepository->find($value);

        if ($group->getOwner() === $user) {
            return;
        }

        $this->context->addViolation($constraint->message);
    }
}