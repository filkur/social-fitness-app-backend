<?php

declare(strict_types=1);

namespace App\Validator\GroupMember;

use App\Entity\Group\Group;
use App\Entity\Invitation\Invitation;
use App\Repository\Invitation\InvitationRepository;
use App\Utils\User\UserGetter;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsLoggedInGroupOwnerValidator extends ConstraintValidator
{
    private InvitationRepository $invitationRepository;

    private UserGetter $userGetter;

    public function __construct(
        InvitationRepository $invitationRepository,
        UserGetter $userGetter
    ) {
        $this->invitationRepository = $invitationRepository;
        $this->userGetter = $userGetter;
    }

    /**
     * @param string               $value
     * @param IsLoggedInGroupOwner $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        /** @var Group $group */
        $group
            = /** @var Invitation $invitation */
        $invitation = $this->invitationRepository->findOneBy([
            'code' => $value,
        ])
                                                 ->getGroup();
        if ($group->getOwner() === $this->userGetter->get()) {
            $this->context->addViolation($constraint->message);
        }
    }
}