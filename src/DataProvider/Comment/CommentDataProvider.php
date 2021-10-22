<?php

declare(strict_types=1);

namespace App\DataProvider\Comment;

use App\DataProvider\Utils\AllDataProvider;
use App\DTO\Comment\Input\CommentInput;
use App\Entity\Comment\Comment;
use App\Repository\Comment\CommentRepository;
use App\Utils\ApiPlatform\ApiPlatformCollectionFilter;
use App\Utils\ReadStorage\MutatorAfterReadStorage;
use Doctrine\ORM\QueryBuilder;

class CommentDataProvider extends AllDataProvider
{
    private CommentRepository $commentRepository;

    public function __construct(
        ApiPlatformCollectionFilter $apiPlatformCollectionFilter,
        MutatorAfterReadStorage $mutatorAfterReadStorage,
        CommentRepository $commentRepository
    ) {
        parent::__construct($apiPlatformCollectionFilter, $mutatorAfterReadStorage);
        $this->commentRepository = $commentRepository;
    }

    protected function isValidResourceClass(string $resource): bool
    {
        return $resource === CommentInput::class || $resource === Comment::class;
    }

    /**
     * @param Comment $object
     */
    protected function createDtoObject(object $object, array $context): object
    {
        return CommentInput::createFromEntity($object);
    }

    protected function findObject($id): ?object
    {
        return $this->commentRepository->find($id);
    }

    protected function getQueryBuilder(): QueryBuilder
    {
        return $this->commentRepository->createQueryBuilder('comment');
    }
}