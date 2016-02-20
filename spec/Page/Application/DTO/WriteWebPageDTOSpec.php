<?php

namespace spec\Black\Page\Application\DTO;

use PhpSpec\ObjectBehavior;

class WriteWebPageDTOSpec extends ObjectBehavior
{
    protected $id;

    protected $headline;

    protected $about;

    protected $text;

    public function let()
    {
        $this->id = 1;
        $this->headline = 'test';
        $this->about = 'test';
        $this->text = 'test';

        $this->beConstructedWith($this->id, $this->headline, $this->about, $this->text);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Black\Page\Application\DTO\WriteWebPageDTO');
    }

    public function it_should_return_id()
    {
        $this->getId()->shouldReturn($this->id);
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
