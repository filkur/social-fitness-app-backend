<?php

declare(strict_types=1);

namespace App\Validator\Activity;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation()
 */
class ActivityDate extends Constraint
{
    public string $message = "the event has ended";

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}