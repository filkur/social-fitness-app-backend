<?php

declare(strict_types=1);

namespace App\DataTransformer\Invitation;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\DTO\Invitation\Output\InvitationOutput;
use App\Entity\Invitation\Invitation;

class InvitationDataTransformer implements DataTransformerInterface
{
    /**
     * @param Invitation $object
     */
    public function transform($object, string $to, array $context = [])
    {
        $output = new InvitationOutput();

        $output->id = $object->getIdString();
        $output->code = $object->getCode();

        return $output;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return $to === InvitationOutput::class && $data instanceof Invitation;
    }
}
