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

use Black\DDD\DDDinPHP\Infrastructure\DomainEvent\DomainEvent;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class WebPageDepublishedEvent
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
final class WebPageDepublishedEvent extends Event implements DomainEvent
{
    /**
     * @var
     */
    protected $webPageId;

    /**
     * @var
     */
    protected $name;

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
        return sprintf('The page %s was successfully depublished for %s identifier', $this->name, $this->webPageId);
    }
} 