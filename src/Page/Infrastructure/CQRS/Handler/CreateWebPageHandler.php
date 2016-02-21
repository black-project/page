<?php

namespace Black\Page\Infrastructure\CQRS\Handler;

use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Command;
use Black\Page\Domain\Event\WebPageCreatedEvent;
use Black\Page\Infrastructure\Persistence\CQRS\WriteRepository;
use Black\Page\Infrastructure\Service\WebPageWriteService;
use Black\Page\WebPageEvents;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class CreateWebPageHandler
 */
final class CreateWebPageHandler implements CommandHandler
{
    /**
     * @var WebPageWriteService
     */
    protected $service;

    /**
     * @var WriteRepository
     */
    protected $repository;

    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * CreateWebPageHandler constructor.
     *
     * @param WebPageWriteService $service
     * @param WriteRepository $repository
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        WebPageWriteService $service,
        WriteRepository $repository,
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
        $page = $this->service->create($command->getWebPageId(), $command->getAuthor(), $command->getName());

        $event = new WebPageCreatedEvent($page->getWebPageId()->getValue(), $page->getName());
        $this->eventDispatcher->dispatch(WebPageEvents::WEBPAGE_DOMAIN_CREATED, $event);
    }
}
