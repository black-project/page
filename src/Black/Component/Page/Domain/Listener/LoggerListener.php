<?php

namespace Black\Component\Page\Domain\Listener;

use Black\Component\Page\WebPageDomainEvents;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class LoggerListener
 */
class LoggerListener implements EventSubscriberInterface
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            WebPageDomainEvents::WEBPAGE_DOMAIN_CREATED => 'addInfoLog',
            WebPageDomainEvents::WEBPAGE_DOMAIN_DEPUBLISHED => 'addInfoLog',
            WebPageDomainEvents::WEBPAGE_DOMAIN_PUBLISHED => 'addInfoLog',
            WebPageDomainEvents::WEBPAGE_DOMAIN_REMOVED => 'addInfoLog',
            WebPageDomainEvents::WEBPAGE_DOMAIN_WRITE => 'addInfoLog',
        ];
    }

    /**
     * @param Event $event
     */
    public function addInfoLog(Event $event)
    {
        $this->logger->info($event->message());
    }
}
