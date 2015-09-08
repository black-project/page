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

use Black\Component\Page\Domain\Model\WebPage;
use Black\Component\Page\Domain\Model\WebPageId;
use Black\Component\Page\Domain\Model\WebPageWriteRepository;

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
     * @param WebPage $webPage
     * @param $headline
     * @param $about
     * @param $text
     * @return WebPage
     */
    public function write(WebPage $webPage, $headline, $about, $text)
    {
        $webPage->write($headline, $about, $text);
        $this->repository->add($webPage);

        return $webPage;
    }

    /**
     * @param WebPage $webPage
     * @param string $dateTime
     * @return WebPage
     */
    public function publish(WebPage $webPage, $dateTime = 'now')
    {
        if ('now' === $dateTime) {
            $dateTime = new \DateTime();
        }

        $webPage->publish($dateTime);
        $this->repository->add($webPage);

        return $webPage;
    }

    /**
     * @param WebPage $webPage
     * @return WebPage
     */
    public function depublish(WebPage $webPage)
    {
        $webPage->depublish();
        $this->repository->add($webPage);

        return $webPage;
    }

    /**
     * @param WebPage $webPage
     * @return WebPage
     */
    public function remove(WebPage $webPage)
    {
        $this->repository->remove($webPage);

        return $webPage;
    }
}
