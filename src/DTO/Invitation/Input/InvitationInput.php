<?php

declare(strict_types=1);

namespace App\DTO\Invitation\Input;
use App\Validator\PropertySetted\IsIdSet;
use App\Entity\Group\Group;

class InvitationInput
{
    /**
     * @IsIdSet(
     *     targetEntity=Group::class
     * )
     */
    public string $groupId;
}