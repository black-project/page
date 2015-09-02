<?php
/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Black\Component\Page\Infrastructure\Service;

use Black\Component\Page\Domain\Exception\WebPageNotFoundException;
use Black\Component\Page\Domain\Model\WebPageId;
use Black\Component\Page\Infrastructure\Doctrine\WebPageManager;

class WebPageReadService
{
    /**
     * @var \Black\Component\Page\Infrastructure\Doctrine\WebPageManager
     */
    protected $manager;

    /**
     * @param WebPageManager $manager
     */
    public function __construct(WebPageManager $manager)
    {
        $this->manager       = $manager;
    }

    /**
     * @param WebPageId $webPageId
     * @return mixed
     */
    public function read(WebPageId $webPageId)
    {
        $page = $this->manager->find($webPageId);

        if (null === $page) {
            throw new WebPageNotFoundException();
        }

        return $page;
    }
}
