<?php

declare(strict_types=1);

namespace App\EventListener;

use ApiPlatform\Core\Util\RequestAttributesExtractor;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class PostValidateListener implements EventSubscriberInterface
{
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->eventDispatcher = $eventDispatcher;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => 'onKernelView',
        ];
    }

    public function onKernelView(ViewEvent $event)
    {
        $request = $event->getRequest();

        if (
            $request->isMethodSafe()
            || $request->isMethod('DELETE')
            || $request->isMethod('GET')
            || ! ($attributes = RequestAttributesExtractor::extractAttributes($request))
            || ! $attributes['receive']
        ) {
            return;
        }

        $this->eventDispatcher->dispatch(new AfterValidateEvent($event));
    }
}
