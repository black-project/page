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
use Black\Component\Page\Domain\Model\WebPageReadRepository;

class WebPageReadService
{
    /**
     * @var WebPageReadRepository
     */
    protected $repository;

    /**
     * @param WebPageReadRepository $repository
     */
    public function __construct(WebPageReadRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param WebPageId $webPageId
     * @return mixed
     */
    public function read(WebPageId $webPageId)
    {
        $page = $this->repository->find($webPageId);

        if (null === $page) {
            throw new WebPageNotFoundException();
        }

        return $page;
    }
}
