<?php
/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Black\Component\Page\Infrastructure\Listener;

use Black\Component\Page\Domain\Event\WebPageRemovedEvent;
use Monolog\Logger;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class WebPageRemovedListener
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
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
