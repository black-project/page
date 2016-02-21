<?php

namespace Black\Page\Application\Action;

use Black\Page\Domain\Model\WebPage;
use Black\Page\Domain\Model\WebPageId;
use Black\Page\Infrastructure\CQRS\Handler\RemoveWebPageHandler;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Bus;

/**
 * Class RemoveWebPage
 */
class RemoveWebPage
{
    /**
     * @var Bus
     */
    protected $bus;

    /**
     * @var
     */
    protected $commandName;

    /**
     * @var RemoveWebPageHandler
     */
    protected $handler;

    /**
     * RemoveWebPage constructor.
     *
     * @param Bus $bus
     * @param RemoveWebPageHandler $handler
     * @param $commandName
     */
    public function __construct(
        Bus $bus,
        RemoveWebPageHandler $handler,
        $commandName
    ) {
        $this->bus = $bus;
        $this->handler = $handler;
        $this->commandName = $commandName;
    }

    /**
     * @param WebPage $page
     */
    public function __invoke(WebPage $page)
    {
        $this->bus->register($this->commandName, $this->handler);
        $this->bus->handle(new $this->commandName($page));
    }
}
