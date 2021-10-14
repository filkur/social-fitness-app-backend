<?php

declare(strict_types=1);

namespace App\Service\Invitation;

use App\DTO\Invitation\Input\InvitationInput;
use App\Entity\Group\Group;
use App\Entity\Invitation\Invitation;
use App\Factory\Invitation\InvitationFactory;
use App\Repository\Group\GroupRepository;
use Ramsey\Uuid\Uuid;

class CreateInvitationService
{
    private GroupRepository $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function createInvitation(InvitationInput $invitationInput): Invitation
    {
        /** @var Group $group */
        $group = $this->groupRepository->find($invitationInput->groupId);

        $code = $this->generateInviteCode();

        $invitation = $group->getInvitation();

        if ($invitation === null) {
            return InvitationFactory::createFromParams(
                $group,
                $code
            );
        }

        $invitation->setCode($code);

        return $invitation;
    }

    private function generateInviteCode(): string
    {
        $uuid = Uuid::uuid4();

        return substr($uuid->toString(), 3, 8);
    }
}