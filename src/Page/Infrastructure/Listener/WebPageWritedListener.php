<?php

namespace Black\Page\Infrastructure\Listener;

use Black\Page\Domain\Event\WebPageWritedEvent;
use Monolog\Logger;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class WebPageWritedListener
 */
class WebPageWritedListener implements EventSubscriberInterface
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
            'web_page.writed' => [
                'onWebPageWrited', 0
            ]
        ];
    }

    /**
     * @param WebPageWritedEvent $event
     */
    public function onWebPageWrited(WebPageWritedEvent $event)
    {
        $this->logger->info($event->execute());
    }
}
