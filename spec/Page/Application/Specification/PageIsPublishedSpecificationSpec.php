<?php

namespace spec\Black\Page\Application\Specification;

use Black\Page\Domain\Model\WebPage;
use Black\Page\Domain\Model\WebPageId;
use PhpSpec\ObjectBehavior;

class PageIsPublishedSpecificationSpec extends ObjectBehavior
{
    protected $page;

    public function it_is_initializable()
    {
        $this->shouldHaveType('Black\Page\Application\Specification\PageIsPublishedSpecification');
    }

    public function let()
    {
        $pageId = new WebPageId('12345');
        $page = new WebPage($pageId, 'test', 'test', 'test');

        $this->page = $page;
    }

    public function it_should_satisfied()
    {
        $this->page->publish(new \DateTime());

        $this->isSatisfiedBy($this->page)->shouldReturn(true);
    }
}
