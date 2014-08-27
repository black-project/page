<?php

namespace Black\Component\Page\Application\DTO;

use Black\Component\Page\Domain\Model\WebPageId;
use Black\DDD\DDDinPHP\Application\DTO\DTO;
use Black\DDD\DDDinPHP\Application\DTO\Transformer;
use Black\DDD\DDDinPHP\Domain\Model\Entity;

/**
 * Class CreateWebPageTransformer
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
class CreateWebPageTransformer implements Transformer
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
     * @param Entity $webPage
     * @return mixed
     */
    public function transform(Entity $webPage)
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
     * @param DTO $webPageDTO
     * @return mixed
     */
    public function reverseTransform(DTO $webPageDTO)
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
