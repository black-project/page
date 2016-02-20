<?php

namespace Black\Page\Application\DTO;

use Black\Page\Domain\Model\WebPage;
use Black\Page\Domain\Model\WebPageId;

/**
 * Class WriteWebPageAssembler
 */
class WriteWebPageAssembler
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
            $webPage->getHeadline(),
            $webPage->getAbout(),
            $webPage->getText()
        );

        return $dto;
    }

    /**
     * @param WriteWebPageDTO $webPageDTO
     * @return mixed
     */
    public function reverseTransform(WriteWebPageDTO $webPageDTO)
    {
        $webPageId = new WebPageId($webPageDTO->getId());

        $entity = new $this->entityClass(
            $webPageId,
            $webPageDTO->getHeadline(),
            $webPageDTO->getAbout(),
            $webPageDTO->getText()
        );

        return $entity;
    }
}
