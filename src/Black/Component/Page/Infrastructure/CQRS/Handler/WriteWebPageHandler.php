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

use Black\Component\Page\Infrastructure\CQRS\Command\WriteWebPageCommand;
use Black\Component\Page\Infrastructure\Doctrine\WebPageManager;
use Black\Component\Page\Infrastructure\DomainEvent\WebPageWritedEvent;
use Black\Component\Page\Infrastructure\DomainEvent\WebPageWritedSubscriber;
use Black\Component\Page\Infrastructure\Service\WebPageWriteService;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class WriteWebPageHandler
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
final class WriteWebPageHandler implements CommandHandler
{
    /**
     * @var \Black\Component\Page\Infrastructure\Service\WebPageWriteService
     */
    protected $service;

    /**
     * @var WebPageManager
     */
    protected $manager;

    /**
     * @var \Symfony\Component\EventDispatcher\EventDispatcher
     */
    protected $eventDispatcher;

    /**
     * @var \Black\Component\Page\Infrastructure\DomainEvent\WebPageWritedSubscriber
     */
    protected $subscriber;

    /**
     * @param WebPageWriteService $service
     * @param WebPageManager $manager
     * @param EventDispatcherInterface $eventDispatcher
     * @param WebPageWritedSubscriber $subscriber
     */
    public function __construct(
        WebPageWriteService $service,
        WebPageManager $manager,
        EventDispatcherInterface $eventDispatcher,
        WebPageWritedSubscriber $subscriber
    ) {
        $this->service         = $service;
        $this->manager         = $manager;
        $this->eventDispatcher = $eventDispatcher;
        $this->subscriber      = $subscriber;
    }

    /**
     * @param  WriteWebPageCommand $command
     * @return mixed
     */
    public function handle(WriteWebPageCommand $command)
    {
        $page = $this->service->write(
            $command->getWebPageId(),
            $command->getHeadline(),
            $command->getAbout(),
            $command->getText()
        );

        $this->manager->flush();

        $event = new WebPageWritedEvent($page->getWebPageId()->getValue(), $page->getName());
        $this->eventDispatcher->addSubscriber($this->subscriber);
        $this->eventDispatcher->dispatch('web_page.writed', $event);
    }
}
