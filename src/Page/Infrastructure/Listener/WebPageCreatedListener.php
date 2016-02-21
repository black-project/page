<?php

namespace Black\Page\Infrastructure\Listener;

use Black\Page\Domain\Event\WebPageCreatedEvent;
use Monolog\Logger;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class WebPageCreatedListener
 */
class WebPageCreatedListener implements EventSubscriberInterface
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
            'web_page.created' => [
                'onWebPageCreated', 0
            ]
        ];
    }

    /**
     * @param WebPageCreatedEvent $event
     * @return mixed
     */
    public function onWebPageCreated(WebPageCreatedEvent $event)
    {
        $this->logger->info($event->execute());
    }
}
