<?php

namespace Black\Page\Infrastructure\Listener;

use Black\Page\Domain\Event\WebPagePublishedEvent;
use Monolog\Logger;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class WebPagePublishedListener
 */
class WebPagePublishedListener implements EventSubscriberInterface
{
    /**
     * @var Logger
     */
    protected $logger;

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
            'web_page.published' => [
                'onWebPagePublished', 0
            ]
        ];
    }

    /**
     * @param WebPagePublishedEvent $event
     */
    public function onWebPagePublished(WebPagePublishedEvent $event)
    {
        $this->logger->info($event->execute());
    }
}
