<?php

namespace App\EventListener;

use App\Entity\Logs;
use App\Entity\Celebrity;
use App\Entity\Representative;
use App\Entity\CelebrityRepresentative;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;

class ActivityLogger implements EventSubscriberInterface
{
     /**
     * @var Security
     */
    private $security;
    
    /**
     * @var logs
     */
    private $logs;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    
    public function getSubscribedEvents(): array
    {
        return [
            Events::postPersist,
            Events::postRemove,
            Events::postUpdate,
        ];
    }
    
    public function postPersist(LifecycleEventArgs $args): void
    {
        $this->logActivity('add', $args);
    }

    public function postRemove(LifecycleEventArgs $args): void
    {
        $this->logActivity('remove', $args);
    }

    public function postUpdate(LifecycleEventArgs $args): void
    {
        $this->logActivity('update', $args);
    }

    private function logActivity(string $action, LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        $entityManager = $args->getEntityManager();
        $user = $this->security->getUser()->getId();
        if ($entity instanceof Celebrity) {
            $section = 'Celebrity';
            $logs = new logs();
            $logs->setSection($section);
            $logs->setAction($action);
            $logs->setUserId($user);
            $logs->setCreated(new \DateTime());
            $logs->setModified(new \DateTime());
            $entityManager->persist($logs);
            $entityManager->flush();
        } else if ($entity instanceof Representative) {
            $section = 'Representative';
            $logs = new logs();
            $logs->setSection($section);
            $logs->setAction($action);
            $logs->setUserId($user);
            $logs->setCreated(new \DateTime());
            $logs->setModified(new \DateTime());
            $entityManager->persist($logs);
            $entityManager->flush();
        } else if ($entity instanceof CelebrityRepresentative) {
            $section = 'CelebrityRepresentative';
            $logs = new logs();
            $logs->setSection($section);
            $logs->setAction($action);
            $logs->setUserId($user);
            $logs->setCreated(new \DateTime());
            $logs->setModified(new \DateTime());
            $entityManager->persist($logs);
            $entityManager->flush();
        }
    }
}
