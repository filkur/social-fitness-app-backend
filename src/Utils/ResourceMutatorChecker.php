<?php

declare(strict_types=1);

namespace App\Utils;

use App\Utils\ReadStorage\MutatorAfterReadStorage;
use LogicException;

class ResourceMutatorChecker
{
    public static function checkResourceWithMutatorResource(
        object $resource,
        MutatorAfterReadStorage $mutatorAfterReadStorage
    ): bool {
        try {
            $mutatorResource = $mutatorAfterReadStorage->getObject();
        } catch (LogicException $exception) {
            return false;
        }

        return $resource === $mutatorResource;
    }
}
