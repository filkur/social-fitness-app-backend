<?php

declare(strict_types=1);

namespace App\DataTransformer\Activity;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\DTO\Activity\Output\ActivityOutput;
use App\Entity\Activity\Activity;
use App\Utils\Date\DateHelper;

class ActivityDataTransformer implements DataTransformerInterface
{
    /**
     * @param Activity $object
     */
    public function transform($object, string $to, array $context = [])
    {
        $output = new ActivityOutput();

        $output->id = $object->getIdString();
        $output->value = $object->getValue();
        $output->name = $object->getName();
        $output->createdAt = DateHelper::toDateFormat(
            $object->getCreatedAt()
        );

        return $output;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return $to === ActivityOutput::class && $data instanceof Activity;
    }
}