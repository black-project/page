<?php

/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Black\Component\Page\Application\Controller;

use Black\Component\Page\Application\Service\WebPageReadService;
use Black\Component\Page\Domain\Model\WebPageId;

/**
 * Class ReadPageController
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
class ReadPageController
{
    /**
     * @var \Black\Component\Page\Application\Service\WebPageReadService
     */
    protected $service;

    /**
     * @param WebPageReadService $service
     */
    public function __construct(WebPageReadService $service)
    {
        $this->service = $service;
    }

    /**
     * @param WebPageId $id
     *
     * @return \Black\Component\Page\Application\DTO\WebPageDTO
     */
    public function readPageAction(WebPageId $id)
    {
        $page = $this->service->read($id);

        return $page;
    }
}
