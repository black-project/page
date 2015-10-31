<?php

namespace spec\Black\Component\Page\Domain\Model;

use Black\Component\Page\Domain\Model\WebPageId;
use PhpSpec\ObjectBehavior;

class WebPageIdSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(12345);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\Page\Domain\Model\WebPageId');
    }

    public function it_should_have_a_value()
    {
        $this->getValue()->shouldBeEqualTo('12345');
    }

    public function it_sould_have_a_magic_toString()
    {
        $this->__toString()->shouldBeEqualTo('12345');
    }

    public function it_should_be_equal()
    {
        $object2 = new WebPageId('12345');

        $this->isEqualTo($object2)->shouldReturn(true);
    }

    public function it_should_not_be_equal()
    {
        $object2 = new WebPageId('1');

        $this->isEqualTo($object2)->shouldReturn(false);
    }
}
