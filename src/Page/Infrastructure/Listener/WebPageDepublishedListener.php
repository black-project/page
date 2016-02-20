<?php

namespace Black\Page\Infrastructure\Listener;

use Black\Page\Domain\Event\WebPageDepublishedEvent;
use Monolog\Logger;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class WebPageDepublishedListener
 */
class WebPageDepublishedListener implements EventSubscriberInterface
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
            'web_page.depublished' => [
                'onWebPageDepublished', 0
            ]
        ];
    }

    /**
     * @param WebPageDepublishedEvent $event
     */
    public function onWebPageDepublished(WebPageDepublishedEvent $event)
    {
        $this->logger->info($event->execute());
    }
}
