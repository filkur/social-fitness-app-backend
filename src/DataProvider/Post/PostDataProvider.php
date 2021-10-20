<?php

declare(strict_types=1);

namespace App\DataProvider\Post;

use App\DataProvider\Utils\AllDataProvider;
use App\DTO\Post\Input\PostInput;
use App\Entity\Post\Post;
use App\Repository\Post\PostRepository;
use App\Utils\ApiPlatform\ApiPlatformCollectionFilter;
use App\Utils\ReadStorage\MutatorAfterReadStorage;
use Doctrine\ORM\QueryBuilder;

class PostDataProvider extends AllDataProvider
{
    private PostRepository $postRepository;

    public function __construct(
        ApiPlatformCollectionFilter $apiPlatformCollectionFilter,
        MutatorAfterReadStorage $mutatorAfterReadStorage,
        PostRepository $postRepository
    ) {
        parent::__construct($apiPlatformCollectionFilter, $mutatorAfterReadStorage);
        $this->postRepository = $postRepository;
    }

    protected function isValidResourceClass(string $resource): bool
    {
        return $resource === Post::class || $resource === PostInput::class;
    }

    /**
     * @param Post $object
     */
    protected function createDtoObject(object $object, array $context): object
    {
        return PostInput::createFromEntity($object);
    }

    protected function findObject($id): ?object
    {
        return $this->postRepository->find($id);
    }

    protected function getQueryBuilder(): QueryBuilder
    {
        return $this->postRepository->createQueryBuilder('post');
    }
}