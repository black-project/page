<?php

namespace Black\Page\Infrastructure\Listener;

use Black\Page\Domain\Event\WebPageRemovedEvent;
use Monolog\Logger;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class WebPageRemovedListener
 */
class WebPageRemovedListener implements EventSubscriberInterface
{
    /**
     * @param Logger $logger
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'web_page.removed' => [
                'onWebPageRemoved', 0
            ]
        ];
    }

    /**
     * @param WebPageRemovedEvent $event
     */
    public function onWebPageRemoved(WebPageRemovedEvent $event)
    {
        $this->logger->info($event->execute());
    }
}
