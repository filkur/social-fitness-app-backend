<?php

declare(strict_types=1);

namespace App\ Service\Invitation;

use App\DTO\Invitation\Input\InvitationInput;
use App\Entity\Group\Group;
use App\Entity\Invitation\Invitation;
use App\Factory\Invitation\InvitationFactory;
use App\Repository\Group\GroupRepository;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Symfony\Component\Uid\Factory\UuidFactory;

class CreateInvitationService
{
    private GroupRepository $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function create(InvitationInput $invitationInput): Invitation
    {
        /** @var Group $group */
        $group = $this->groupRepository->find($invitationInput->groupId);
        $code = $this->generateInviteCode();

        return InvitationFactory::createFromParams(
            $group,
            $code
        );
    }

    private function generateInviteCode(): string
    {
        return "12345678";
    }
}