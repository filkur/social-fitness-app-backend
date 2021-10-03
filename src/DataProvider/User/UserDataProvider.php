<?php

declare(strict_types=1);

namespace App\DataProvider\User;

use App\DataProvider\Utils\AllDataProvider;
use App\DTO\User\Input\UserInput;
use App\Entity\User\User;
use App\Repository\User\UserRepository;
use App\Utils\ApiPlatform\ApiPlatformCollectionFilter;
use App\Utils\ReadStorage\MutatorAfterReadStorage;
use Doctrine\ORM\QueryBuilder;

class UserDataProvider extends AllDataProvider
{
    private UserRepository $userRepository;

    public function __construct(
        ApiPlatformCollectionFilter $apiPlatformCollectionFilter,
        MutatorAfterReadStorage $mutatorAfterReadStorage,
        UserRepository $userRepository
    ) {
        parent::__construct($apiPlatformCollectionFilter, $mutatorAfterReadStorage);
        $this->userRepository = $userRepository;
    }

    protected function isValidResourceClass(string $resource): bool
    {
        return $resource === User::class || $resource === UserInput::class;
    }

    /**
     * @param User $object
     */
    protected function createDtoObject(object $object, array $context): object
    {
        return UserInput::createFromEntity($object);
    }

    protected function findObject($id): ?object
    {
        return $this->userRepository->find($id);
    }

    protected function getQueryBuilder(): QueryBuilder
    {
        return $this->userRepository->createQueryBuilder('user');
    }
}