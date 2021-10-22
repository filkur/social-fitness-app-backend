<?php

declare(strict_types=1);

namespace App\DataTransformer\Group;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\DTO\Group\Output\GroupOutput;
use App\DTO\Invitation\Output\InvitationOutput;
use App\DTO\User\Output\UserOutput;
use App\Entity\Group\Group;
use App\Utils\Date\DateHelper;

class GroupDataTransformer implements DataTransformerInterface
{
    /**
     * @param Group $object
     */
    public function transform($object, string $to, array $context = [])
    {
        $output = new GroupOutput();

        $output->id = $object->getIdString();
        $output->owner = UserOutput::createFromUser(
            $object->getOwner()
        );
        $output->name = $object->getName();
        $output->description = $object->getDescription();
        $output->groupMembers = $object->getGroupMembersArray();

        $output->posts = $object->getPosts()->toArray();

        $output->createdAt = DateHelper::toDateTimeFormat(
            $object->getCreatedAt()
        );

        $output->updatedAt = DateHelper::toDateTimeFormat(
            $object->getUpdatedAt()
        );

        if ($object->getInvitation() === null) {
            return $output;
        }
        $output->invitation = InvitationOutput::createFromInvitation(
            $object->getInvitation()
        );

        return $output;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return $to === GroupOutput::class && $data instanceof Group;
    }
}