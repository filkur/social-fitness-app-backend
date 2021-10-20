<?php

declare(strict_types=1);

namespace App\EventListener\Comment;

use App\DTO\Comment\Input\CommentInput;
use App\Entity\Comment\Comment;
use App\EventListener\AbstractValidateTransformer;
use App\Repository\Comment\CommentRepository;
use App\Utils\DataHelper\MethodHelper;
use App\Utils\ReadStorage\MutatorAfterReadStorage;
use App\Utils\User\UserGetter;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class CommentPatchValidateTransformer extends AbstractValidateTransformer
{
    private UserGetter $userGetter;

    private CommentRepository $commentRepository;

    public function __construct(
        MutatorAfterReadStorage $mutatorAfterReadStorage,
        ContainerInterface $container,
        UserGetter $userGetter,
        CommentRepository $commentRepository
    ) {
        parent::__construct($mutatorAfterReadStorage, $container);
        $this->userGetter = $userGetter;
        $this->commentRepository = $commentRepository;
    }

    protected function validPayload(object $payload): bool
    {
        return $payload instanceof CommentInput;
    }

    protected function validRequest(Request $request): bool
    {
        return MethodHelper::isRequestPatch($request);
    }

    /**
     * @param CommentInput $payload
     */
    protected function transform(object $payload): object
    {
        /** @var Comment $comment */
        $comment = $this->commentRepository->find($payload->id);

        $comment->setContent($payload->content);

        return $comment;
    }
}