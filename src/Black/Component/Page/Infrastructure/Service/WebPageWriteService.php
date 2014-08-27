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
use Black\DDD\DDDinPHP\Infrastructure\Service\InfrastructureService;

class WebPageWriteService implements InfrastructureService
{
    /**
     * @var \Black\Component\Page\Infrastructure\Doctrine\WebPageManager
     */
    protected $manager;

    /**
     * @param WebPageManager $webPageManager
     */
    public function __construct(WebPageManager $webPageManager)
    {
        $this->manager = $webPageManager;
    }

    /**
     * return mixed
     */
    public function create(WebPageId $webPageId, $author, $name)
    {
        $webPage = $this->manager->createWebPage($webPageId, $author, $name);

        $this->manager->add($webPage);

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
        $webPage = $this->manager->find($webPageId);

        if (null === $webPage) {
            throw new WebPageNotFoundException();
        }

        $webPage->write($headline, $about, $text);
        $this->manager->add($webPage);

        return $webPage;
    }

    /**
     * @param WebPageId $webPageId
     * @param string $dateTime
     *
     * @return mixed
     * @throws \Black\Component\Page\Domain\Exception\WebPageNotFoundException
     */
    public function publish(WebPageId $webPageId, $dateTime = 'now')
    {
        $webPage = $this->manager->find($webPageId);

        if (null === $webPage) {
            throw new WebPageNotFoundException();
        }

        if ('now' === $dateTime) {
            $dateTime = new \DateTime();
        }

        $webPage->publish($dateTime);
        $this->manager->add($webPage);

        return $webPage;
    }

    /**
     * @param WebPageId $webPageId
     * @return mixed
     *
     * @throws \Black\Component\Page\Domain\Exception\WebPageNotFoundException
     */
    public function depublish(WebPageId $webPageId)
    {
        $webPage = $this->manager->find($webPageId);

        if (null === $webPage) {
            throw new WebPageNotFoundException();
        }

        $webPage->depublish();
        $this->manager->add($webPage);

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
        $webPage = $this->manager->find($webPageId);

        if (null === $webPage) {
            throw new WebPageNotFoundException();
        }

        $this->manager->remove($webPage);

        return $webPage;
    }
}
