<?php

declare(strict_types=1);

namespace App\EventListener;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Utils\ReadStorage\MutatorAfterReadStorage;
use Psr\Container\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Service\ServiceSubscriberInterface;

abstract class AbstractValidateTransformer implements EventSubscriberInterface, ServiceSubscriberInterface
{
    protected ContainerInterface $container;

    protected MutatorAfterReadStorage $mutatorAfterReadStorage;

    public function __construct(
        MutatorAfterReadStorage $mutatorAfterReadStorage,
        ContainerInterface $container
    ) {
        $this->container = $container;
        $this->mutatorAfterReadStorage = $mutatorAfterReadStorage;
        $this->initClasses();
    }

    /**
     * haystack
     */
    protected function initClasses(): void
    {
    }

    final public static function getSubscribedServices(): array
    {
        return static::registerClasses();
    }

    /**
     * haystack
     */
    protected static function registerClasses(): array
    {
        return [];
    }

    public static function getSubscribedEvents(): array
    {
        return [
            AfterValidateEvent::class => ['templateTransform', EventPriorities::PRE_WRITE],
        ];
    }

    final public function templateTransform(AfterValidateEvent $afterValidateEvent): void
    {
        $event = $afterValidateEvent->getEvent();
        $payload = $event->getControllerResult();
        if (! $this->supportTransformation($payload, $event->getRequest())) {
            return;
        }

        $event->setControllerResult($this->transform($payload));
    }

    final public function supportTransformation($payload, Request $request): bool
    {
        return $this->validPayload($payload) && $this->validRequest($request);
    }

    abstract protected function validPayload(object $payload): bool;

    abstract protected function validRequest(Request $request): bool;

    /**
     * @return object - the object that should be placed in controllerResult
     */
    abstract protected function transform(object $payload): object;
}
