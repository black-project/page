<?php
/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Black\Component\Page\Infrastructure\CQRS\Command;

use Black\Component\Page\Domain\Model\WebPageId;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Command;

/**
 * Class RemoveWebPageCommand
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
final class RemoveWebPageCommand implements Command
{
    /**
     * @var
     */
    protected $webPageId;

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