<?php

namespace Black\Page\Application\Action;

use Black\Page\Domain\Model\WebPageId;
use Black\Page\Infrastructure\CQRS\Handler\CreateWebPageHandler;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Bus;

/**
 * Class CreateWebPage
 */
class CreateWebPage
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
     * @var CreateWebPageHandler
     */
    protected $handler;

    /**
     * CreateWebPage constructor.
     *
     * @param Bus $bus
     * @param CreateWebPageHandler $handler
     * @param $commandName
     */
    public function __construct(
        Bus $bus,
        CreateWebPageHandler $handler,
        $commandName
    ) {
        $this->bus = $bus;
        $this->handler = $handler;
        $this->commandName = $commandName;
    }

    /**
     * @param WebPageId $id
     * @param $author
     * @param $name
     */
    public function __invoke(WebPageId $id, $author, $name)
    {
        $this->bus->register($this->commandName, $this->handler);
        $this->bus->handle(new $this->commandName($id, $author, $name));
    }
}
