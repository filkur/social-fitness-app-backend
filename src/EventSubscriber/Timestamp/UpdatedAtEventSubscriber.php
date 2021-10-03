<?php

declare(strict_types=1);

namespace App\EventSubscriber\Timestamp;

use App\Entity\Traits\Timestamp\UpdatedAtInterface;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;

class UpdatedAtEventSubscriber implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return [
            Events::prePersist,
            Events::preUpdate,
        ];
    }

    public function __call($name, $arguments)
    {
        $lifecycleEventArgs = $arguments[0];

        $object = $lifecycleEventArgs->getObject();
        if (! $object instanceof UpdatedAtInterface) {
            return;
        }

        $object->stampUpdatedAt();
    }
}
