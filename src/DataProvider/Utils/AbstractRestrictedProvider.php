<?php

declare(strict_types=1);

namespace App\DataProvider\Utils;

use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;

abstract class AbstractRestrictedProvider implements RestrictedDataProviderInterface
{
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return $this->isValidResourceClass($resourceClass)
               && $this->isValidOperationName($operationName)
               && $this->isValidMethod($context);
    }

    abstract protected function isValidResourceClass(string $resource): bool;

    protected function isValidOperationName(string $operationName): bool
    {
        return true;
    }

    abstract protected function isValidMethod(array $context): bool;
}
