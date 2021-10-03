<?php

declare(strict_types=1);

namespace App\Utils\ReadStorage;

class MutatorAfterReadStorage
{
    private ?object $object = null;

    public function isObjectNull(): bool
    {
        return $this->object === null;
    }

    public function getObject(): object
    {
        if ($this->object === null) {
            throw new \LogicException("No object to update");
        }

        return $this->object;
    }

    public function setObject(object $object): void
    {
        $this->object = $object;
    }
}
