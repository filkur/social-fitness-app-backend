<?php

declare(strict_types=1);

namespace App\EventSubscriber\Timestamp;

use App\Entity\Traits\Timestamp\CreatedAtInterface;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class CreatedAtEventSubscriber implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return [
            Events::prePersist,
        ];
    }

    public function prePersist(LifecycleEventArgs $lifecycleEventArgs): void
    {
        $object = $lifecycleEventArgs->getObject();
        if (! $object instanceof CreatedAtInterface) {
            return;
        }

        $object->stampCreatedAt();
    }
}
