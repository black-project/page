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

use Black\Component\Page\Domain\Model\WebPageWriteRepository;
use Black\Component\Page\Infrastructure\CQRS\Command\WriteWebPageCommand;
use Black\Component\Page\Domain\Event\WebPageWriteEvent;
use Black\Component\Page\Infrastructure\Service\WebPageWriteService;
use Black\Component\Page\WebPageDomainEvents;
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
     * @var WebPageWriteService
     */
    protected $service;

    /**
     * @var WebPageWriteRepository
     */
    protected $repository;

    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * @param WebPageWriteService $service
     * @param WebPageWriteRepository $repository
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        WebPageWriteService $service,
        WebPageWriteRepository $repository,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->service         = $service;
        $this->repository      = $repository;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param  WriteWebPageCommand $command
     * @return mixed
     */
    public function handle(WriteWebPageCommand $command)
    {
        $page = $this->service->write(
            $command->getWebPage(),
            $command->getHeadline(),
            $command->getAbout(),
            $command->getText()
        );

        $this->repository->flush();

        $event = new WebPageWriteEvent($page->getWebPageId()->getValue(), $page->getName());
        $this->eventDispatcher->dispatch(WebPageDomainEvents::WEBPAGE_DOMAIN_WRITE, $event);
    }
}
