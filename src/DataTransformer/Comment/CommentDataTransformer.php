<?php

declare(strict_types=1);

namespace App\DataTransformer\Comment;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\DTO\Comment\Output\CommentOutput;
use App\DTO\User\Output\UserOutput;
use App\Entity\Comment\Comment;
use App\Utils\Date\DateHelper;

class CommentDataTransformer implements DataTransformerInterface
{
    /**
     * @param Comment $object
     */
    public function transform($object, string $to, array $context = [])
    {
        $output = new CommentOutput();

        $output->id = $object->getIdString();
        $output->content = $object->getContent();
        $output->createdBy = UserOutput::createFromUser(
            $object->getOwner()
        );
        $output->createdAt = DateHelper::toDateTimeFormat(
            $object->getCreatedAt()
        );

        $output->updatedAt = DateHelper::toDateTimeFormat(
            $object->getUpdatedAt()
        );

        return $output;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return $to === CommentOutput::class && $data instanceof Comment;
    }
}