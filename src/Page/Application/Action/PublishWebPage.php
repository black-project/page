<?php

namespace Black\Page\Application\Action;

use Black\Page\Domain\Model\WebPageId;
use Black\Page\Infrastructure\CQRS\Handler\PublishWebPageHandler;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Bus;

/**
 * Class PublishWebPage
 */
class PublishWebPage
{
    /**
     * @var \Black\DDD\CQRSinPHP\Infrastructure\CQRS\Bus
     */
    protected $bus;

    /**
     * @var
     */
    protected $commandName;

    /**
     * @var \Black\Page\Infrastructure\CQRS\Handler\PublishWebPageHandler
     */
    protected $handler;

    /**
     * PublishWebPage constructor.
     *
     * @param Bus $bus
     * @param PublishWebPageHandler $handler
     * @param $commandName
     */
    public function __construct(
        Bus $bus,
        PublishWebPageHandler $handler,
        $commandName
    ) {
        $this->bus = $bus;
        $this->handler = $handler;
        $this->commandName = $commandName;
    }

    /**
     * @param WebPageId $id
     */
    public function __invoke(WebPageId $id)
    {
        $this->bus->register($this->commandName, $this->handler);
        $this->bus->handle(new $this->commandName($id));
    }
}
