<?php

namespace Black\Page\Application\DTO;

use Black\Page\Domain\Model\WebPage;
use Black\Page\Domain\Model\WebPageId;

/**
 * Class CreateWebPageAssembler
 */
class CreateWebPageAssembler
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
        $this->dtoClass = $dtoClass;
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
