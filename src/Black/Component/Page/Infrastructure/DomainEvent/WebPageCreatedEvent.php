<?php
/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Black\Component\Page\Infrastructure\DomainEvent;

use Symfony\Component\EventDispatcher\Event;

/**
 * Class WebPageCreatedEvent
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
final class WebPageCreatedEvent extends Event
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
    public function execute()
    {
        return sprintf('The page %s was successfully created with %s identifier', $this->name, $this->webPageId);
    }

    /**
     * @return mixed
     */
    public function getWebPageId()
    {
        return $this->webPageId;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
