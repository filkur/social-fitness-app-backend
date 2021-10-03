<?php

declare(strict_types=1);

namespace App\DataProvider\Utils;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;

abstract class ItemProvider extends AbstractRestrictedProvider implements ItemDataProviderInterface
{
    abstract protected function findObject($id): ?object;
}
