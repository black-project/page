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

use Black\Component\Page\Domain\Model\WebPage;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Command;

/**
 * Class PublishWebPageCommand
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
final class PublishWebPageCommand implements Command
{
    /**
     * @var WebPage
     */
    private $webPage;

    /**
     * @param WebPage $webPage
     */
    public function __construct(WebPage $webPage)
    {
        $this->webPage = $webPage;
    }

    /**
     * @return mixed
     */
    public function getWebPage()
    {
        return $this->webPage;
    }
}
