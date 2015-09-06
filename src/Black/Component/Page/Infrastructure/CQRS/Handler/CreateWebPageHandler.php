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

use Black\Component\Page\Infrastructure\CQRS\Command\CreateWebPageCommand;
use Black\Component\Page\Infrastructure\Doctrine\WebPageManager;
use Black\Component\Page\Domain\Event\WebPageCreatedEvent;
use Black\Component\Page\Infrastructure\Listener\WebPageCreatedListener;
use Black\Component\Page\Infrastructure\Service\WebPageWriteService;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class CreateWebPageHandler
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
final class CreateWebPageHandler implements CommandHandler
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
     * @var \Black\Component\Page\Infrastructure\Listener\WebPageCreatedListener
     */
    protected $listener;

    /**
     * @param WebPageWriteService $service
     * @param WebPageManager $manager
     * @param EventDispatcherInterface $eventDispatcher
     * @param WebPageCreatedListener $listener
     */
    public function __construct(
        WebPageWriteService $service,
        WebPageManager $manager,
        EventDispatcherInterface $eventDispatcher,
        WebPageCreatedListener $listener
    ) {
        $this->service         = $service;
        $this->manager         = $manager;
        $this->eventDispatcher = $eventDispatcher;
        $this->listener        = $listener;
    }

    /**
     * @param  CreateWebPageCommand $command
     * @return mixed
     */
    public function handle(CreateWebPageCommand $command)
    {
        $page = $this->service->create($command->getWebPageId(), $command->getAuthor(), $command->getName());
        $this->manager->flush();

        $event = new WebPageCreatedEvent($page->getWebPageId()->getValue(), $page->getName(), $page->getDateCreated());
        $this->eventDispatcher->addSubscriber($this->listener);

        $this->eventDispatcher->dispatch('web_page.created', $event);
    }
}
