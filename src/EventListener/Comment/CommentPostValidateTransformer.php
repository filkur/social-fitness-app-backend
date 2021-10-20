<?php

declare(strict_types=1);

namespace App\EventListener\Comment;

use App\DTO\Comment\Input\CommentInput;
use App\Entity\User\User;
use App\EventListener\AbstractValidateTransformer;
use App\Factory\Comment\CommentFactory;
use App\Repository\Post\PostRepository;
use App\Utils\DataHelper\MethodHelper;
use App\Utils\ReadStorage\MutatorAfterReadStorage;
use App\Utils\User\UserGetter;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class CommentPostValidateTransformer extends AbstractValidateTransformer
{
    private UserGetter $userGetter;

    private PostRepository $postRepository;

    public function __construct(
        MutatorAfterReadStorage $mutatorAfterReadStorage,
        ContainerInterface $container,
        UserGetter $userGetter,
        PostRepository $postRepository
    ) {
        parent::__construct($mutatorAfterReadStorage, $container);
        $this->userGetter = $userGetter;
        $this->postRepository = $postRepository;
    }

    protected function validPayload(object $payload): bool
    {
        return $payload instanceof CommentInput;
    }

    protected function validRequest(Request $request): bool
    {
        return MethodHelper::isRequestPost($request);
    }

    /**
     * @param CommentInput $payload
     */
    protected function transform(object $payload): object
    {
        /** @var User $user */
        $user = $this->userGetter->get();

        $post = $this->postRepository->find($payload->postId);

        return CommentFactory::createFromParams(
            $user,
            $post,
            $payload->content
        );
    }
}