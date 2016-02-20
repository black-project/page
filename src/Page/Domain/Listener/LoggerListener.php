<?php

namespace Black\Page\Domain\Listener;

use Black\Page\WebPageEvents;
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
            WebPageEvents::WEBPAGE_DOMAIN_CREATED => 'addInfoLog',
            WebPageEvents::WEBPAGE_DOMAIN_DEPUBLISHED => 'addInfoLog',
            WebPageEvents::WEBPAGE_DOMAIN_PUBLISHED => 'addInfoLog',
            WebPageEvents::WEBPAGE_DOMAIN_REMOVED => 'addInfoLog',
            WebPageEvents::WEBPAGE_DOMAIN_WRITE => 'addInfoLog',
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
