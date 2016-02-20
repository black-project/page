<?php

namespace Black\Page\Application\Action;

use Black\Page\Application\DTO\WriteWebPageDTO;
use Black\Page\Domain\Model\WebPageId;
use Black\Page\Infrastructure\CQRS\Handler\WriteWebPageHandler;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Bus;

/**
 * Class WriteWebPage
 */
class WriteWebPage
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
     * @var \Black\Page\Infrastructure\CQRS\Handler\WriteWebPageHandler
     */
    protected $handler;

    /**
     * WriteWebPage constructor.
     *
     * @param Bus $bus
     * @param WriteWebPageHandler $handler
     * @param $commandName
     */
    public function __construct(
        Bus $bus,
        WriteWebPageHandler $handler,
        $commandName
    ) {
        $this->bus = $bus;
        $this->handler = $handler;
        $this->commandName = $commandName;
    }

    /**
     * @param WriteWebPageDTO $dto
     */
    public function __invoke(WriteWebPageDTO $dto)
    {
        $this->bus->register($this->commandName, $this->handler);
        $this->bus->handle(new $this->commandName(
            new WebPageId($dto->getId()),
            $dto->getHeadline(),
            $dto->getAbout(),
            $dto->getText()
        ));
    }
}
