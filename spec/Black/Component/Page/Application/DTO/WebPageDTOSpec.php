<?php

namespace spec\Black\Component\Page\Application\DTO;

use PhpSpec\ObjectBehavior;

class WebPageDTOSpec extends ObjectBehavior
{
    protected $id;

    protected $author;

    protected $name;

    protected $headline;

    protected $about;

    protected $text;

    public function let()
    {
        $this->id       = 1;
        $this->author   = 'test';
        $this->name     = 'test';
        $this->headline = 'test';
        $this->about    = 'test';
        $this->text     = 'test';

        $this->beConstructedWith($this->id, $this->author, $this->name, $this->headline, $this->about, $this->text);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\Page\Application\DTO\WebPageDTO');
        $this->shouldImplement('Black\DDD\DDDinPHP\Application\DTO\DTO');
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

    public function it_should_return_headline()
    {
        $this->getHeadline()->shouldReturn($this->headline);
    }

    public function it_should_return_about()
    {
        $this->getAbout()->shouldReturn($this->about);
    }

    public function it_should_return_text()
    {
        $this->getText()->shouldReturn($this->text);
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
