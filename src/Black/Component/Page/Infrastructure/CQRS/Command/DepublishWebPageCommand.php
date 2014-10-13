<?php
/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Black\Bundle\PageBundle\Infrastructure\CQRS\Command;

use Black\Component\Page\Domain\Model\WebPageId;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Command;

/**
 * Class DepublishWebPageCommand
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
final class DepublishWebPageCommand implements Command
{
    /**
     * @var \Black\Component\Page\Domain\Model\WebPageId
     */
    private $webPageId;

    /**
     * @param WebPageId $webPageId
     */
    public function __construct(WebPageId $webPageId)
    {
        $this->webPageId = $webPageId;
    }

    /**
     * @return mixed
     */
    public function getWebPageId()
    {
        return $this->webPageId;
    }
}
