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

use Black\Component\Page\Infrastructure\CQRS\Command\PublishWebPageCommand;
use Black\Component\Page\Infrastructure\Doctrine\WebPageManager;
use Black\Component\Page\Infrastructure\DomainEvent\WebPagePublishedEvent;
use Black\Component\Page\Infrastructure\DomainEvent\WebPagePublishedSubscriber;
use Black\Component\Page\Infrastructure\Service\WebPageWriteService;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class DepublishWebPageHandler
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
final class DepublishWebPageHandler implements CommandHandler
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
     * @var \Black\Component\Page\Infrastructure\DomainEvent\WebPagePublishedSubscriber
     */
    protected $subscriber;

    /**
     * @param WebPageWriteService $service
     * @param WebPageManager $manager
     * @param EventDispatcherInterface $eventDispatcher
     * @param WebPagePublishedSubscriber $subscriber
     */
    public function __construct(
        WebPageWriteService $service,
        WebPageManager $manager,
        EventDispatcherInterface $eventDispatcher,
        WebPagePublishedSubscriber $subscriber
    ) {
        $this->service         = $service;
        $this->manager         = $manager;
        $this->eventDispatcher = $eventDispatcher;
        $this->subscriber      = $subscriber;
    }

    /**
     * @param  PublishWebPageCommand $command
     * @return mixed
     */
    public function handle(PublishWebPageCommand $command)
    {
        $page = $this->service->depublish($command->getWebPageId());

        $this->manager->flush();

        $event = new WebPagePublishedEvent($page->getWebPageId()->getValue(), $page->getName());
        $this->eventDispatcher->addSubscriber($this->subscriber);
        $this->eventDispatcher->dispatch('web_page.depublished', $event);
    }
}
