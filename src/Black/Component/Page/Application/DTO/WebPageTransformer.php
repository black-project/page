<?php
/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Black\Component\Page\Application\DTO;

use Black\Component\Page\Domain\Model\WebPage;
use Black\Component\Page\Domain\Model\WebPageId;

/**
 * Class WebPageTransformer
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
class WebPageTransformer
{
    /**
     * @var
     */
    protected $entityClass;

    /**
     * @var
     */
    protected $dtoClass;

    /**
     * @param $entityClass
     * @param $dtoClass
     */
    public function __construct($entityClass, $dtoClass)
    {
        $this->entityClass = $entityClass;
        $this->dtoClass    = $dtoClass;
    }

    /**
     * @param WebPage $webPage
     * @return mixed
     * @throws \Exception
     */
    public function transform(WebPage $webPage)
    {
        $dto = new $this->dtoClass(
            $webPage->getWebPageId()->getValue(),
            $webPage->getAuthor(),
            $webPage->getName(),
            $webPage->getHeadline(),
            $webPage->getAbout(),
            $webPage->getText(),
            $webPage->getAuthor(),
            $webPage->getAuthor()
        );

        return $dto;
    }

    /**
     * @param WebPageDTO $webPageDTO
     * @return mixed
     * @throws \Exception
     */
    public function reverseTransform(WebPageDTO $webPageDTO)
    {
        $webPageId = new WebPageId($webPageDTO->getId());

        $entity = new $this->entityClass(
            $webPageId,
            $webPageDTO->getName(),
            $webPageDTO->getAuthor(),
            $webPageDTO->getHeadline(),
            $webPageDTO->getAbout(),
            $webPageDTO->getText()
        );

        return $entity;
    }

    /**
     * @param $object
     * @param $class
     *
     * @throws \Exception
     */
    protected function verify($object, $class)
    {
        if (!$object instanceof $class) {
            throw new \Exception();
        }
    }
}
