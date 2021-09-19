<?php

declare(strict_types=1);

namespace App\EventSubscriber\User;

use App\Entity\User\User;
use App\Service\Doctrine\SubscriberCollectionDuplicateResolver;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

class UserPasswordEncoderEventSubscriber implements EventSubscriberInterface
{
    private PasswordHasherFactoryInterface $passwordHasher;

    private SubscriberCollectionDuplicateResolver $subscriberCollectionDuplicateResolver;

    public function __construct(
        PasswordHasherFactoryInterface $passwordHasher,
        SubscriberCollectionDuplicateResolver $subscriberCollectionDuplicateResolver
    ) {
        $this->passwordHasher = $passwordHasher;
        $this->subscriberCollectionDuplicateResolver = $subscriberCollectionDuplicateResolver;
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist => 'prePersist',
            Events::preUpdate  => 'preUpdate',
        ];
    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if (! $entity instanceof User) {
            return;
        }
        if ($this->subscriberCollectionDuplicateResolver->canBeProceeded($entity, $this)) {
            return;
        }

        $this->encodePassword($entity);
    }

    private function encodePassword(User $user): void
    {
        $user->setPassword(
            $this->passwordHasher->getPasswordHasher($user)
                                 ->hash(
                                     $user->getPassword()
                                 )
        );
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if (! $entity instanceof User) {
            return;
        }
        if ($this->subscriberCollectionDuplicateResolver->canBeProceeded($entity, $this)) {
            return;
        }

        $this->encodePassword($entity);
    }
}
