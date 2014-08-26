<?php

/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Black\Component\Page\Infrastructure\Doctrine;

use Black\Component\Page\Domain\Model\WebPageId;

/**
 * Interface WebPageManager
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
interface WebPageManager
{
    /**
     * Create an object
     *
     * @param WebPageId $id
     * @param $author
     * @param $name
     *
     * @return mixed
     */
    public function createWebPage(WebPageId $id, $author, $name);
}
