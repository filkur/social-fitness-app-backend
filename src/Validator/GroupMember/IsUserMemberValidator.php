<?php

declare(strict_types=1);

namespace App\Validator\GroupMember;

use App\Entity\GroupMember\GroupMember;
use App\Entity\Invitation\Invitation;
use App\Entity\User\User;
use App\Repository\Invitation\InvitationRepository;
use App\Utils\User\UserGetter;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsUserMemberValidator extends ConstraintValidator
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
     * @param string       $value
     * @param IsUserMember $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        /** @var Invitation $invitation */
        $invitation = $this->invitationRepository->findOneBy([
            'code' => $value,
        ]);

        if ($invitation !== null){
            $group = $invitation->getGroup();
            /** @var User $user */
            $user = $this->userGetter->get();

            $assignedUser = $group->getGroupMembers()
                                  ->filter(function (GroupMember $groupMember) use ($user) {
                                      return $groupMember->getUser() === $user;
                                  });

            if (! $assignedUser->isEmpty()) {
                $this->context->addViolation($constraint->message);
            }
        }
    }
}