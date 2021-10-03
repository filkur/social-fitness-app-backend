<?php

declare(strict_types=1);

namespace App\DataProvider\Utils;

use App\Utils\DataHelper\MethodHelper;
use Symfony\Component\Uid\Ulid;

abstract class ItemAccesorProvider extends ItemProvider
{
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        if (! Ulid::isValid($id)) {
            return null;
        }

        return $this->findObject($id);
    }

    protected function isValidMethod(array $context): bool
    {
        return ! MethodHelper::isPut($context);
    }
}
