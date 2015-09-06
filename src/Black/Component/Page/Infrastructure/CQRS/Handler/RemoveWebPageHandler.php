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
use Black\Component\Page\Infrastructure\Doctrine\WebPageManager;
use Black\Component\Page\Domain\Event\WebPageRemovedEvent;
use Black\Component\Page\Infrastructure\Listener\WebPageRemovedListener;
use Black\Component\Page\Infrastructure\Service\WebPageWriteService;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class RemoveWebPageHandler
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
final class RemoveWebPageHandler implements CommandHandler
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
     * @var \Black\Component\Page\Infrastructure\Listener\WebPageRemovedListener
     */
    protected $subscriber;

    /**
     * @param WebPageWriteService $service
     * @param WebPageManager $manager
     * @param EventDispatcherInterface $eventDispatcher
     * @param WebPageRemovedListener $listener
     */
    public function __construct(
        WebPageWriteService $service,
        WebPageManager $manager,
        EventDispatcherInterface $eventDispatcher,
        WebPageRemovedListener $listener
    ) {
        $this->service         = $service;
        $this->manager         = $manager;
        $this->eventDispatcher = $eventDispatcher;
        $this->listener        = $listener;
    }

    /**
     * @param  RemoveWebPageCommand $command
     * @return mixed
     */
    public function handle(RemoveWebPageCommand $command)
    {
        $page = $this->service->remove($command->getWebPageId());

        $this->manager->flush();

        $event = new WebPageRemovedEvent($page->getWebPageId()->getValue(), $page->getName());
        $this->eventDispatcher->addSubscriber($this->listener);
        $this->eventDispatcher->dispatch('web_page.removed', $event);
    }
}
