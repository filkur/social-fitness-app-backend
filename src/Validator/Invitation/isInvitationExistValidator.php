<?php

declare(strict_types=1);

namespace App\Validator\Invitation;

use App\Repository\Invitation\InvitationRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class isInvitationExistValidator extends ConstraintValidator
{
    private InvitationRepository $invitationRepository;

    public function __construct(InvitationRepository $invitationRepository)
    {
        $this->invitationRepository = $invitationRepository;
    }

    /**
     * @param string            $value
     * @param isInvitationExist $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        $invitation = $this->invitationRepository->findOneBy([
            'code' => $value,
        ]);
        if ($invitation === null) {
            $this->context->addViolation($constraint->message);
        }
    }
}
