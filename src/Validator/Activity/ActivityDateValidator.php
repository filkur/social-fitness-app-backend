<?php

declare(strict_types=1);

namespace App\Validator\Activity;

use App\DTO\Activity\Input\ActivityInput;
use App\Entity\Event\Event;
use App\Repository\Event\EventRepository;
use DateTimeImmutable;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ActivityDateValidator extends ConstraintValidator
{
    private EventRepository $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    /**
     * @param ActivityInput $value
     * @param ActivityDate  $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        /** @var Event $event */
        $event = $this->eventRepository->find($value->eventId);

        $currentDate = new DateTimeImmutable();

        if ($currentDate > $event->getEndDate()) {
            $this->context->buildViolation($constraint->message)
                          ->setCode('403')
                          ->addViolation()
            ;
        }
    }
}