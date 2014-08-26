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

use Black\Component\Page\Infrastructure\CQRS\Command\RemoveWebPageCommand;
use Black\Component\Page\Infrastructure\Doctrine\WebPageManagerInterface;
use Black\Component\Page\Infrastructure\DomainEvent\WebPageRemovedEvent;
use Black\Component\Page\Infrastructure\DomainEvent\WebPageRemovedSubscriber;
use Black\Component\Page\Infrastructure\Service\WebPageWriteService;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandlerInterface;
use Symfony\Component\EventDispatcher\Debug\TraceableEventDispatcher;

/**
 * Class RemoveWebPageHandler
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
final class RemoveWebPageHandler implements CommandHandlerInterface
{
    /**
     * @var \Black\Component\Page\Infrastructure\Service\WebPageWriteService
     */
    protected $service;

    /**
     * @var \Black\Component\Page\Infrastructure\Doctrine\WebPageManagerInterface
     */
    protected $manager;

    /**
     * @var \Symfony\Component\EventDispatcher\Debug\TraceableEventDispatcher
     */
    protected $eventDispatcher;

    /**
     * @var \Black\Component\Page\Infrastructure\DomainEvent\WebPageRemovedSubscriber
     */
    protected $subscriber;

    /**
     * @param WebPageWriteService $service
     * @param WebPageManagerInterface $manager
     * @param TraceableEventDispatcher $eventDispatcher
     * @param WebPageRemovedSubscriber $subscriber
     */
    public function __construct(
        WebPageWriteService $service,
        WebPageManagerInterface $manager,
        TraceableEventDispatcher $eventDispatcher,
        WebPageRemovedSubscriber $subscriber
    ) {
        $this->service         = $service;
        $this->manager         = $manager;
        $this->eventDispatcher = $eventDispatcher;
        $this->subscriber      = $subscriber;
    }

    /**
     * @param RemoveWebPageCommand $command
     * @return mixed
     */
    public function handle(RemoveWebPageCommand $command)
    {
        $page = $this->service->remove($command->getWebPageId());

        $this->manager->flush();

        $event = new WebPageRemovedEvent($page->getWebPageId()->getValue(), $page->getName());
        $this->eventDispatcher->addSubscriber($this->subscriber);
        $this->eventDispatcher->dispatch('web_page.removed', $event);
    }
}