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

use Black\Component\Common\Infrastructure\Doctrine\CommonManager;
use Black\Component\Page\Domain\Model\WebPageId;
use Black\Component\Page\Domain\Model\WebPage;

/**
 * Class WebPageManager
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
class WebPageManager extends CommonManager
{
    /**
     * @param WebPageId $id
     * @param string $name
     * @param $author
     * @return mixed
     */
    public function createWebPage(WebPageId $id, $author, $name)
    {
        $class   = $this->getClass();
        $webPage = new $class($id, $name, $author);

        return $webPage;
    }

    /**
     * @param WebPageId $id
     * @return mixed
     */
    public function find(WebPageId $id)
    {
        return $this->repository->findWebPageByWebPageId($id);
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->repository->findAll();
    }

    /**
     * @param $webPage
     * @throws \InvalidArgumentException
     */
    public function add(WebPage $webPage)
    {
        if (!$webPage instanceof $this->class) {
            throw new \InvalidArgumentException(gettype($webPage));
        }

        $this->manager->persist($webPage);
    }

    /**
     * @param $webPage
     * @throws \InvalidArgumentException
     */
    public function remove(WebPage $webPage)
    {
        if (!$webPage instanceof $this->class) {
            throw new \InvalidArgumentException(gettype($webPage));
        }

        $this->getManager()->remove($webPage);
    }
}