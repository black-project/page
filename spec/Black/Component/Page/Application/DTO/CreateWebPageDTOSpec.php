<?php

namespace spec\Black\Component\Page\Application\DTO;

use PhpSpec\ObjectBehavior;

class CreateWebPageDTOSpec extends ObjectBehavior
{
    protected $id;

    protected $author;

    protected $name;

    public function let()
    {
        $this->id     = 1;
        $this->author = 'test';
        $this->name   = 'test';

        $this->beConstructedWith($this->id, $this->author, $this->name);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\Page\Application\DTO\CreateWebPageDTO');
    }

    public function it_should_return_id()
    {
        $this->getId()->shouldReturn($this->id);
    }

    public function it_should_return_author()
    {
        $this->getAuthor()->shouldReturn($this->author);
    }

    public function it_should_return_name()
    {
        $this->getName()->shouldReturn($this->name);
    }

    public function it_should_return_context()
    {
        $this->getContext()->shouldReturn("http://schema.org");
    }

    public function it_should_return_type()
    {
        $this->getType()->shouldReturn("WebPage");
    }

    public function it_should_serialize()
    {
        $this->serialize()->shouldBeString();
    }

    public function it_should_unserialize()
    {
        $serialized = $this->serialize();

        $object = $this->unserialize($serialized);
        $object->shouldBeArray();
    }
}
