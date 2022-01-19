<?php

namespace App\EventSubscriber;

use App\Entity\Category;
use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AdminSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setCreatedAt'],
            BeforeEntityUpdatedEvent::class => ['setUpdatedAt']
        ];
    }

    public function setCreatedAt(BeforeEntityPersistedEvent $event)
    {
        $entityInstance = $event->getEntityInstance();

        if (!$entityInstance instanceof Product && !$entityInstance instanceof Category) return;

        $entityInstance->setCreatedAt(new \DateTimeImmutable);
    }

    public function setUpdatedAt(BeforeEntityUpdatedEvent $event)
    {
        $entityInstance = $event->getEntityInstance();

        if (!$entityInstance instanceof Product && !$entityInstance instanceof Category) return;

        $entityInstance->setUpdatedAt(new \DateTimeImmutable);
    }
}
