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

use Black\Component\Page\Domain\Model\WebPageId;
use Black\Component\Page\Domain\Model\WebPageWriteRepository;
use Black\Component\Page\Infrastructure\CQRS\Command\WriteWebPageCommand;
use Black\Component\Page\Domain\Event\WebPageWritedEvent;
use Black\Component\Page\Infrastructure\Service\WebPageReadService;
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
     * @var WebPageReadService
     */
    protected $readService;

    /**
     * @var WebPageWriteService
     */
    protected $writeService;

    /**
     * @var WebPageWriteRepository
     */
    protected $repository;

    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * WriteWebPageHandler constructor.
     * @param WebPageReadService $readService
     * @param WebPageWriteService $writeService
     * @param WebPageWriteRepository $repository
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        WebPageReadService $readService,
        WebPageWriteService $writeService,
        WebPageWriteRepository $repository,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->readService = $readService;
        $this->writeService = $writeService;
        $this->repository      = $repository;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param  WriteWebPageCommand $command
     * @return mixed
     */
    public function handle(WriteWebPageCommand $command)
    {
        $page = $this->readService->read($command->getWebPageId());
        $page = $this->writeService->write(
            $page,
            $command->getHeadline(),
            $command->getAbout(),
            $command->getText()
        );

        $this->repository->flush();

        $event = new WebPageWritedEvent($page->getWebPageId()->getValue(), $page->getName());
        $this->eventDispatcher->dispatch(WebPageDomainEvents::WEBPAGE_DOMAIN_WRITE, $event);
    }
}
