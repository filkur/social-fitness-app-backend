<?php

declare(strict_types=1);

namespace App\DataTransformer\Invitation;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\DTO\Invitation\Output\InvitationOutput;
use App\Entity\Invitation\Invitation;
use App\Utils\Date\DateHelper;

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
        return $to === InvitationOutput::class && $data instanceof Invitation;
    }
}
