<?php

declare(strict_types=1);

namespace App\DataTransformer\GroupMember;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\DTO\GroupMember\Output\GroupMemberOutput;
use App\DTO\User\Output\UserOutput;
use App\Entity\GroupMember\GroupMember;
use App\Utils\Date\DateHelper;

class GroupMemberDataTransformer implements DataTransformerInterface
{
    /**
     * @param GroupMember $object
     */
    public function transform($object, string $to, array $context = [])
    {
        $output = new GroupMemberOutput();

        $output->id = $object->getIdString();
        $output->user = UserOutput::createFromUser(
            $object->getUser()
        );
        $output->assignedAt = DateHelper::toDateFormat(
            $object->getAssignedAt()
        );

        return $output;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return $to === GroupMemberOutput::class && $data instanceof GroupMember;
    }
}