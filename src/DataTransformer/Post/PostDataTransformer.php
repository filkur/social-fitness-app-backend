<?php

declare(strict_types=1);

namespace App\DataTransformer\Post;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\DTO\Post\Output\PostOutput;
use App\DTO\User\Output\UserOutput;
use App\Entity\Post\Post;
use App\Utils\Date\DateHelper;

class PostDataTransformer implements DataTransformerInterface
{
    /**
     * @param Post $object
     */
    public function transform($object, string $to, array $context = [])
    {
        $output = new PostOutput();

        $output->id = $object->getIdString();
        $output->content = $object->getContent();
        $output->createdBy = UserOutput::createFromUser(
            $object->getOwner()
        );
        $output->comments = $object->getComments()
                                   ->toArray();
        $output->createdAt = DateHelper::toDateFormat(
            $object->getCreatedAt()
        );
        $output->updatedAt = DateHelper::toDateFormat(
            $object->getUpdatedAt()
        );

        return $output;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return $to === PostOutput::class && $data instanceof Post;
    }
}