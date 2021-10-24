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

        $type = $object->getEvent()
                       ->getEventType();
        switch ($type) {
            case 'REP':
                $ratio = $object->getEvent()
                                ->getPointsPerRep();
                foreach ($object->getActivities() as $activity) {
                    /** @var Activity $activity */
                    $output->totalScore += $activity->getValue() * $ratio;
                }
                break;
            case 'TIME':
                $ratio = $object->getEvent()
                                ->getPointsPerMinute();
                foreach ($object->getActivities() as $activity) {
                    /** @var Activity $activity */
                    $output->totalScore += ((int)($activity->getValue() / 60)) * $ratio;
                }
                break;
            default:
                foreach ($object->getActivities() as $activity) {
                    /** @var Activity $activity */
                    $output->totalScore += $activity->getValue();
                }
                break;
        }

        return $output;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return $to === EventMemberOutput::class && $data instanceof EventMember;
    }
}