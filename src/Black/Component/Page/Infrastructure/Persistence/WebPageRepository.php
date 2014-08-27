<?php

/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Black\Component\Page\Infrastructure\Persistence;

use Black\Component\Page\Domain\Model\WebPageId;
use Black\DDD\DDDinPHP\Infrastructure\Persistence\Repository;

/**
 * Interface WebPageRepository
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
interface WebPageRepository extends Repository
{
    public function findWebPageByWebPageId(WebPageId $id);
}
