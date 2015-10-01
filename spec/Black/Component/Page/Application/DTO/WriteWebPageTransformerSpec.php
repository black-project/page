<?php

namespace spec\Black\Component\Page\Application\DTO;

use Black\Component\Page\Domain\Model\WebPageId;
use PhpSpec\ObjectBehavior;

class WriteWebPageAssemblerSpec extends ObjectBehavior
{
    protected $entityClass;

    protected $dtoClass;

    public function let()
    {
        $this->entityClass = 'Black\Component\Page\Domain\Model\WebPage';
        $this->dtoClass    = 'Black\Component\Page\Application\DTO\WriteWebPageDTO';

        $this->beConstructedWith($this->entityClass, $this->dtoClass);
    }

    public function it_should_transform()
    {
        $entity = new $this->entityClass(new WebPageId(1), 'test', 'test', 'test');
        $this->transform($entity)->shouldReturnAnInstanceOf($this->dtoClass);
    }

    public function it_should_reverseTransform()
    {
        $dto = new $this->dtoClass(1, 'test', 'test', 'test');
        $this->reverseTransform($dto)->shouldReturnAnInstanceOf($this->entityClass);
    }
}
