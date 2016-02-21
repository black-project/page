<?php

namespace Black\Page\Infrastructure\CQRS\Handler;

use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Command;
use Black\Page\Domain\Model\WebPageId;
use Black\Page\Domain\Event\WebPageWritedEvent;
use Black\Page\Infrastructure\Persistence\CQRS\WriteRepository;
use Black\Page\Infrastructure\Service\WebPageReadService;
use Black\Page\Infrastructure\Service\WebPageWriteService;
use Black\Page\WebPageEvents;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class WriteWebPageHandler
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
     * @var WriteRepository
     */
    protected $repository;

    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * WriteWebPageHandler constructor.
     *
     * @param WebPageReadService $readService
     * @param WebPageWriteService $writeService
     * @param WriteRepository $repository
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        WebPageReadService $readService,
        WebPageWriteService $writeService,
        WriteRepository $repository,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->readService = $readService;
        $this->writeService = $writeService;
        $this->repository = $repository;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param Command $command
     */
    public function handle(Command $command)
    {
        $page = $this->readService->read($command->getWebPageId());
        $page = $this->writeService->write(
            $page,
            $command->getHeadline(),
            $command->getAbout(),
            $command->getText()
        );

        $event = new WebPageWritedEvent($page->getWebPageId()->getValue(), $page->getName());
        $this->eventDispatcher->dispatch(WebPageEvents::WEBPAGE_DOMAIN_WRITE, $event);
    }
}
