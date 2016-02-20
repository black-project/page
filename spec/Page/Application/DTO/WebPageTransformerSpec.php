<?php

namespace spec\Black\Page\Application\DTO;

use Black\Page\Domain\Model\WebPageId;
use PhpSpec\ObjectBehavior;

class WebPageAssemblerSpec extends ObjectBehavior
{
    protected $entityClass;

    protected $dtoClass;

    public function let()
    {
        $this->entityClass = 'Black\Page\Domain\Model\WebPage';
        $this->dtoClass = 'Black\Page\Application\DTO\WebPageDTO';

        $this->beConstructedWith($this->entityClass, $this->dtoClass);
    }

    public function it_should_transform()
    {
        $entity = new $this->entityClass(new WebPageId(1), 'test', 'test');
        $this->transform($entity)->shouldReturnAnInstanceOf($this->dtoClass);
    }

    public function it_should_reverseTransform()
    {
        $dto = new $this->dtoClass(1, 'test', 'test');
        $this->reverseTransform($dto)->shouldReturnAnInstanceOf($this->entityClass);
    }
}
