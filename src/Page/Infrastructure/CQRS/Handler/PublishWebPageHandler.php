<?php

namespace Black\Page\Infrastructure\CQRS\Handler;

use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Command;
use Black\Page\Domain\Model\WebPageWriteRepository;
use Black\Page\Domain\Event\WebPagePublishedEvent;
use Black\Page\Infrastructure\Service\WebPageWriteService;
use Black\Page\WebPageEvents;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class PublishWebPageHandler
 */
final class PublishWebPageHandler implements CommandHandler
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
     * PublishWebPageHandler constructor.
     *
     * @param WebPageWriteService $service
     * @param WebPageWriteRepository $repository
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        WebPageWriteService $service,
        WebPageWriteRepository $repository,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->service = $service;
        $this->repository = $repository;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param Command $command
     */
    public function handle(Command $command)
    {
        $page = $this->service->publish($command->getWebPage());

        $this->repository->flush();

        $event = new WebPagePublishedEvent($page->getWebPageId()->getValue(), $page->getName());
        $this->eventDispatcher->dispatch(WebPageEvents::WEBPAGE_DOMAIN_PUBLISHED, $event);
    }
}
