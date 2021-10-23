<?php

declare(strict_types=1);

namespace App\DataTransformer\EventMember;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\DTO\EventMember\Output\EventMemberOutput;
use App\DTO\User\Output\UserOutput;
use App\Entity\Activity\Activity;
use App\Entity\EventMember\EventMember;

class EventMemberDataTransformer implements DataTransformerInterface
{
    /**
     * @param EventMember $object
     */
    public function transform($object, string $to, array $context = [])
    {
        $output = new EventMemberOutput();

        $output->user = UserOutput::createFromUser(
            $object->getUser()
        );

        $output->activities = $object->getActivities()
                                     ->toArray();

        $ratio = 1;

        $type = $object->getEvent()
                       ->getEventType();
        switch ($type) {
            case 'REP':
                $ratio = $object->getEvent()
                                ->getPointsPerRep();
                break;
            case 'TIME':
                $ratio = $object->getEvent()
                                ->getPointsPerMinute();
                break;
            default:
                break;
        }

        foreach ($object->getActivities() as $activity) {
            /** @var Activity $activity */
            $output->totalScore += $activity->getValue() * $ratio;
        }

        return $output;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return $to === EventMemberOutput::class && $data instanceof EventMember;
    }
}