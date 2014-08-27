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
use Black\Component\Page\Infrastructure\DomainEvent\WebPageCreatedEvent;
use Black\Component\Page\Infrastructure\DomainEvent\WebPageCreatedSubscriber;
use Black\Component\Page\Infrastructure\Service\WebPageWriteService;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler;
use Symfony\Component\EventDispatcher\Debug\TraceableEventDispatcher;

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
     * @var \Black\Component\Page\Infrastructure\DomainEvent\WebPageCreatedSubscriber
     */
    protected $subscriber;

    /**
     * @param WebPageWriteService $service
     * @param WebPageManager $manager
     * @param TraceableEventDispatcher $eventDispatcher
     * @param WebPageCreatedSubscriber $subscriber
     */
    public function __construct(
        WebPageWriteService $service,
        WebPageManager $manager,
        TraceableEventDispatcher $eventDispatcher,
        WebPageCreatedSubscriber $subscriber
    ) {
        $this->service         = $service;
        $this->manager         = $manager;
        $this->eventDispatcher = $eventDispatcher;
        $this->subscriber      = $subscriber;
    }

    /**
     * @param CreateWebPageCommand $command
     * @return mixed
     */
    public function handle(CreateWebPageCommand $command)
    {
        $page = $this->service->create($command->getWebPageId(), $command->getAuthor(), $command->getName());
        $this->manager->flush();

        $event = new WebPageCreatedEvent($page->getWebPageId()->getValue(), $page->getName(),$page->getDateCreated());
        $this->eventDispatcher->addSubscriber($this->subscriber);

        $this->eventDispatcher->dispatch('web_page.created', $event);
    }
}
