<?php

declare(strict_types=1);

namespace App\DTO\GroupMember\Input;

use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Invitation\isInvitationExist as isInvitationExistAssert;
use App\Validator\GroupMember\IsUserMember as isUserMemberAssert;
use App\Validator\GroupMember\IsLoggedInGroupOwner as isLoggedInGroupOwnerAssert;

class GroupMemberInput
{
    /**
     * @Assert\NotBlank()
     * @Assert\Type(
     *     type="string"
     * )
     * @Assert\Length(
     *     max=8,
     *     min=8
     * )
     * @isInvitationExistAssert()
     * @isUserMemberAssert()
     * @isLoggedInGroupOwnerAssert()
     */
    public string $code;
}