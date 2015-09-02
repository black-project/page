<?php

namespace Black\Component\Page\Application\DTO;

use Black\Component\Page\Domain\Model\WebPage;
use Black\Component\Page\Domain\Model\WebPageId;

/**
 * Class CreateWebPageTransformer
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
class CreateWebPageTransformer
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
     */
    public function transform(WebPage $webPage)
    {
        $dto = new $this->dtoClass(
            $webPage->getWebPageId()->getValue(),
            $webPage->getAuthor(),
            $webPage->getName()
        );

        return $dto;
    }

    /**
     * @param WebPageDTO $webPageDTO
     * @return mixed
     */
    public function reverseTransform(WebPageDTO $webPageDTO)
    {
        $webPageId = new WebPageId($webPageDTO->getId());

        $webPage = new $this->entityClass(
            $webPageId,
            $webPageDTO->getName(),
            $webPageDTO->getAuthor()
        );

        return $webPage;
    }
}
