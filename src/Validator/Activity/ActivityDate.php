<?php

declare(strict_types=1);

namespace App\Validator\Activity;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation()
 */
class ActivityDate extends Constraint
{
    public string $startErrorMessage = "The event not started yet";

    public string $endErrorMessage = "The event has ended";

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}