<?php

declare(strict_types=1);

namespace App\DataProvider\Group;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Group\Group;
use App\Entity\User\User;
use App\Utils\User\UserGetter;

class GroupCollectionDataProvider
    implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private UserGetter $userGetter;

    public function __construct(
        UserGetter $userGetter
    ) {
        $this->userGetter = $userGetter;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = [])
    {
        /** @var User $owner */
        $owner = $this->userGetter->get();

        return $owner->getGroups();
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Group::class === $resourceClass;
    }
}
