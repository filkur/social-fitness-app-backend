<?php

declare(strict_types=1);

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\ViewEvent;

class AfterValidateEvent
{
    private ViewEvent $event;

    public function __construct(
        ViewEvent $event
    ) {
        $this->event = $event;
    }

    public function getEvent(): ViewEvent
    {
        return $this->event;
    }
}
