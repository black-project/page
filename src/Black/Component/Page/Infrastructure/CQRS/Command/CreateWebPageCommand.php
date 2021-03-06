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
 * Class CreateWebPageCommand
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
final class CreateWebPageCommand implements Command
{
    /**
     * @var \Black\Component\Page\Domain\Model\WebPageId
     */
    private $webPageId;

    /**
     * @var
     */
    private $author;

    /**
     * @var
     */
    private $name;

    /**
     * @param WebPageId $webPageId
     * @param $author
     * @param $name
     */
    public function __construct(WebPageId $webPageId, $author, $name)
    {
        $this->webPageId = $webPageId;
        $this->author    = $author;
        $this->name      = $name;
    }

    /**
     *
     */
    public function getWebPageId()
    {
        return $this->webPageId;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
}
