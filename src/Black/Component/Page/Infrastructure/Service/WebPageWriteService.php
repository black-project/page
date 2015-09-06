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
use Black\Component\Page\Domain\Model\WebPageWriteRepository;
use Black\Component\Page\Infrastructure\Doctrine\WebPageManager;

class WebPageWriteService
{
    /**
     * @var WebPageWriteRepository
     */
    protected $repository;

    /**
     * @var
     */
    protected $class;

    /**
     * @param WebPageWriteRepository $repository
     */
    public function __construct(WebPageWriteRepository $repository)
    {
        $this->repository = $repository;
        $this->class = $repository->getClassName();
    }

    /**
     * @param WebPageId $webPageId
     * @param $author
     * @param $name
     * @return mixed
     */
    public function create(WebPageId $webPageId, $author, $name)
    {
        $webPage = new $this->class($webPageId, $author, $name);

        $this->repository->add($webPage);

        return $webPage;
    }

    /**
     * @param WebPageId $webPageId
     * @param $headline
     * @param $about
     * @param $text
     *
     * @return mixed
     * @throws \Black\Component\Page\Domain\Exception\WebPageNotFoundException
     */
    public function write(WebPageId $webPageId, $headline, $about, $text)
    {
        $webPage = $this->repository->find($webPageId);

        if (null === $webPage) {
            throw new WebPageNotFoundException();
        }

        $webPage->write($headline, $about, $text);
        $this->repository->add($webPage);

        return $webPage;
    }

    /**
     * @param WebPageId $webPageId
     * @param string    $dateTime
     *
     * @return mixed
     * @throws \Black\Component\Page\Domain\Exception\WebPageNotFoundException
     */
    public function publish(WebPageId $webPageId, $dateTime = 'now')
    {
        $webPage = $this->repository->find($webPageId);

        if (null === $webPage) {
            throw new WebPageNotFoundException();
        }

        if ('now' === $dateTime) {
            $dateTime = new \DateTime();
        }

        $webPage->publish($dateTime);
        $this->repository->add($webPage);

        return $webPage;
    }

    /**
     * @param  WebPageId $webPageId
     * @return mixed
     *
     * @throws \Black\Component\Page\Domain\Exception\WebPageNotFoundException
     */
    public function depublish(WebPageId $webPageId)
    {
        $webPage = $this->repository->find($webPageId);

        if (null === $webPage) {
            throw new WebPageNotFoundException();
        }

        $webPage->depublish();
        $this->repository->add($webPage);

        return $webPage;
    }

    /**
     * @param WebPageId $webPageId
     *
     * @return mixed
     * @throws \Black\Component\Page\Domain\Exception\WebPageNotFoundException
     */
    public function remove(WebPageId $webPageId)
    {
        $webPage = $this->repository->find($webPageId);

        if (null === $webPage) {
            throw new WebPageNotFoundException();
        }

        $this->repository->remove($webPage);

        return $webPage;
    }
}
