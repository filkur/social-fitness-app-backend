<?php

declare(strict_types=1);

namespace App\Validator\Post;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation()
 */
class IsLoggedPostOrGroupOwner extends Constraint
{
    public string $message = "Only post owner or group owner can update/delete this post";

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}