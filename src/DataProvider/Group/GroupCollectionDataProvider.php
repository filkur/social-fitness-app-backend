<?php

declare(strict_types=1);

namespace App\DataProvider\Group;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Group\Group;
use App\Entity\GroupMember\GroupMember;
use App\Entity\User\User;
use App\Repository\Group\GroupRepository;
use App\Repository\GroupMember\GroupMemberRepository;
use App\Utils\User\UserGetter;
use Doctrine\Common\Collections\ArrayCollection;

class GroupCollectionDataProvider
    implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private UserGetter $userGetter;

    private GroupMemberRepository $groupMemberRepository;

    public function __construct(
        UserGetter $userGetter,
        GroupMemberRepository $groupMemberRepository
    ) {
        $this->userGetter = $userGetter;
        $this->groupMemberRepository = $groupMemberRepository;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = [])
    {
        /** @var User $owner */
        $owner = $this->userGetter->get();

        $ownerGroupsArray = $owner->getGroups()->toArray();


        $ownerGroupMembers = new ArrayCollection(
            $this->groupMemberRepository->findBy([
                'user' => $owner
            ])
        );

        $ownerGroupMemberArray = [];
        foreach ($ownerGroupMembers as $groupMember) {
            /** @var GroupMember $groupMember */
            $ownerGroupMemberArray[] = $groupMember->getGroup();
        }

        return new ArrayCollection(
            array_merge(
                $ownerGroupsArray,
                $ownerGroupMemberArray
            )
        );
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Group::class === $resourceClass;
    }
}
