<?php

declare(strict_types=1);

namespace App\EventListener\Post;

use App\DTO\Post\Input\PostInput;
use App\Entity\Post\Post;
use App\EventListener\AbstractValidateTransformer;
use App\Utils\DataHelper\MethodHelper;
use Symfony\Component\HttpFoundation\Request;

class PostPatchValidateTransformer extends AbstractValidateTransformer
{
    protected function validPayload(object $payload): bool
    {
        return $payload instanceof PostInput;
    }

    protected function validRequest(Request $request): bool
    {
        return MethodHelper::isRequestPatch($request);
    }

    /**
     * @param PostInput $payload
     */
    protected function transform(object $payload): object
    {
        /** @var Post $post */
        $post = $this->mutatorAfterReadStorage->getObject();

        $post->setContent($payload->content);

        return $post;
    }
}
