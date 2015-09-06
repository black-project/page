<?php
/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Black\Component\Page\Infrastructure\CQRS\Handler;

use Black\Component\Page\Domain\Event\WebPageDepublishedEvent;
use Black\Component\Page\Infrastructure\CQRS\Command\PublishWebPageCommand;
use Black\Component\Page\Infrastructure\Doctrine\WebPageManager;
use Black\Component\Page\Domain\Event\WebPagePublishedEvent;
use Black\Component\Page\Infrastructure\Listener\WebPagePublishedListener;
use Black\Component\Page\Infrastructure\Service\WebPageWriteService;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class PublishWebPageHandler
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
final class PublishWebPageHandler implements CommandHandler
{
    /**
     * @var \Black\Component\Page\Infrastructure\Service\WebPageWriteService
     */
    protected $service;

    /**
     * @var \Black\Component\Page\Infrastructure\Doctrine\WebPageManager
     */
    protected $manager;

    /**
     * @var \Symfony\Component\EventDispatcher\Debug\TraceableEventDispatcher
     */
    protected $eventDispatcher;

    /**
     * @var \Black\Component\Page\Infrastructure\Listener\WebPagePublishedListener
     */
    protected $subscriber;

    /**
     * @param WebPageWriteService $service
     * @param WebPageManager $manager
     * @param EventDispatcherInterface $eventDispatcher
     * @param WebPagePublishedListener $listener
     */
    public function __construct(
        WebPageWriteService $service,
        WebPageManager $manager,
        EventDispatcherInterface $eventDispatcher,
        WebPagePublishedListener $listener
    ) {
        $this->service         = $service;
        $this->manager         = $manager;
        $this->eventDispatcher = $eventDispatcher;
        $this->listener      = $listener;
    }

    /**
     * @param  PublishWebPageCommand $command
     * @return mixed
     */
    public function handle(PublishWebPageCommand $command)
    {
        $page = $this->service->publish($command->getWebPageId());

        $this->manager->flush();

        $event = new WebPagePublishedEvent($page->getWebPageId()->getValue(), $page->getName());
        $this->eventDispatcher->addSubscriber($this->listener);
        $this->eventDispatcher->dispatch('web_page.published', $event);
    }
}
