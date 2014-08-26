<?php

namespace Black\Component\Page\Application\DTO;

use Black\Component\Page\Domain\Model\WebPageId;
use Black\Component\Page\Domain\Model\WebPageInterface;

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
     * @param WebPageInterface $webPage
     * @return mixed
     */
    public function transform(WebPageInterface $webPage)
    {
        $this->verify($webPage, $this->entityClass);

        $dto = new $this->dtoClass(
            $webPage->getWebPageId()->getValue(),
            $webPage->getAuthor(),
            $webPage->getName()
        );

        return $dto;
    }

    /**
     * @param CreateWebPageDTO $webPageDTO
     * @return mixed
     */
    public function reverseTransform(CreateWebPageDTO $webPageDTO)
    {
        $this->verify($webPageDTO, $this->dtoClass);

        $webPageId = new WebPageId($webPageDTO->getId());

        $webPage = new $this->entityClass(
            $webPageId,
            $webPageDTO->getName(),
            $webPageDTO->getAuthor()
        );

        return $webPage;
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
