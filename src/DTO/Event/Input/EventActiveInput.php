<?php

declare(strict_types=1);

namespace App\DTO\Event\Input;

class EventActiveInput
{
    public ?string $id = null;

    public bool $isActive = false;
}