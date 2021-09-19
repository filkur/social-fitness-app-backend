<?php

declare(strict_types=1);

namespace App\DataTransformer\User;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Entity\User\User;
use App\DTO\User\Output\UserOutput;

class UserDataTransformer implements DataTransformerInterface
{
    /**
     * @param User $object
     */
    public function transform($object, string $to, array $context = [])
    {
        $output = new UserOutput();

        $output->id = $object->getIdString();
        $output->email = $object->getEmail();
        $output->nickname = $object->getNickname();

        return $output;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return $to === UserOutput::class && $data instanceof User;
    }
}