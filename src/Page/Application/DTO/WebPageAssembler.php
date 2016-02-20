<?php

namespace Black\Page\Application\DTO;

use Black\Page\Domain\Model\WebPage;
use Black\Page\Domain\Model\WebPageId;

/**
 * Class WebPageAssembler
 */
class WebPageAssembler
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
            $webPage->getText()
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
