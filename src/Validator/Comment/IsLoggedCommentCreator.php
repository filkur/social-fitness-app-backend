<?php

declare(strict_types=1);

namespace App\Validator\Comment;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation()
 */
class IsLoggedCommentCreator extends Constraint
{
    public string $message = 'Comment can be delete or update by its creator';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}