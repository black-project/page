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

use Black\Component\Page\Domain\Model\WebPageId;
use Black\Component\Page\Infrastructure\CQRS\Handler\CreateWebPageHandler;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Bus;

/**
 * Class CreatePageController
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
class CreatePageController
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
     * @var \Black\Component\Page\Infrastructure\CQRS\Handler\CreateWebPageHandler
     */
    protected $handler;

    /**
     * @param Bus $bus
     * @param CreateWebPageHandler $handler
     * @param $commandName
     */
    public function __construct(
        Bus $bus,
        CreateWebPageHandler $handler,
        $commandName
    ) {
        $this->bus         = $bus;
        $this->handler     = $handler;
        $this->commandName = $commandName;
    }

    /**
     * @param WebPageId $id
     * @param $author
     * @param $name
     */
    public function createPageAction(WebPageId $id, $author, $name)
    {
        $this->bus->register($this->commandName, $this->handler);
        $this->bus->handle(new $this->commandName($id, $author, $name));
    }
}
