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
 * Class WriteWebPageCommand
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
final class WriteWebPageCommand implements Command
{
    /**
     * @var \Black\Component\Page\Domain\Model\WebPage
     */
    private $webPage;

    /**
     * @var
     */
    private $headline;

    /**
     * @var
     */
    private $about;

    /**
     * @var
     */
    private $text;

    /**
     * @param WebPage $webPage
     * @param $headline
     * @param $about
     * @param $text
     */
    public function __construct(WebPage $webPage, $headline, $about, $text)
    {
        $this->webPage = $webPage;
        $this->headline = $headline;
        $this->about = $about;
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getWebPage()
    {
        return $this->webPage;
    }

    /**
     * @return mixed
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * @return mixed
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }
}
