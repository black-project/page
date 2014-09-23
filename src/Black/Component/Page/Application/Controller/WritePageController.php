<?php

/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Black\Component\Page\Application\Controller;

use Black\Component\Page\Application\DTO\WriteWebPageDTO;
use Black\Component\Page\Domain\Model\WebPageId;
use Black\Component\Page\Infrastructure\CQRS\Handler\WriteWebPageHandler;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Bus;

/**
 * Class WritePageController
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
class WritePageController
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
     * @var \Black\Component\Page\Infrastructure\CQRS\Handler\WriteWebPageHandler
     */
    protected $handler;

    /**
     * @param Bus                 $bus
     * @param WriteWebPageHandler $handler
     * @param $commandName
     */
    public function __construct(
        Bus $bus,
        WriteWebPageHandler $handler,
        $commandName
    ) {
        $this->bus         = $bus;
        $this->handler     = $handler;
        $this->commandName = $commandName;
    }

    /**
     * @param WriteWebPageDTO $page
     */
    public function writePageAction(WriteWebPageDTO $page)
    {
        $this->bus->register($this->commandName, $this->handler);

        $this->bus->handle(new $this->commandName(
                new WebPageId($page->getId()),
                $page->getHeadline(),
                $page->getAbout(),
                $page->getText()
            ));
    }
}
