<?php
/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Black\Component\Page\Domain\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Class WebPageDepublishedEvent
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
final class WebPageDepublishedEvent extends Event
{
    /**
     * @var
     */
    private $webPageId;

    /**
     * @var
     */
    private $name;

    /**
     * @param $webPageId
     * @param $name
     */
    public function __construct($webPageId, $name)
    {
        $this->webPageId = $webPageId;
        $this->name      = $name;
    }

    /**
     * @return string
     */
    public function message()
    {
        return "The page {$this->name} was successfully depublished for {$this->webPageId} identifier";
    }
}
