<?php

namespace spec\Black\Component\Page\Domain\Model;

use Black\Component\Page\Domain\Model\WebPage;
use Black\Component\Page\Domain\Model\WebPageId;
use PhpSpec\ObjectBehavior;

class WebPageSpec extends ObjectBehavior
{
    protected $webPageId;

    protected $name;

    protected $author;

    protected $slug;

    protected $headline;

    protected $about;

    protected $text;

    protected $dateCreated;

    protected $dateModified;

    protected $datePublished;

    public function let()
    {
        $pageId = new WebPageId('12345');
        $page   = new WebPage($pageId, 'test', 'test');

        $this->webPageId = $page->getWebPageId();
        $this->name      = $page->getName();
        $this->author    = $page->getAUthor();

        $this->beConstructedWith($this->webPageId, $this->name, $this->author);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\Page\Domain\Model\WebPage');
    }

    public function it_should_have_a_dateCreated()
    {
        $this->getDateCreated()->shouldHaveType('DateTime');
    }

    public function it_should_have_a_dateModified()
    {
        $this->getDateCreated()->shouldHaveType('DateTime');
    }

    public function it_should_not_be_published()
    {
        $this->shouldNotBePublished();
    }

    public function it_should_be_write()
    {
        $this->headline = "headline";
        $this->about    = "about";
        $this->text     = "text";

        $this->write($this->headline, $this->about, $this->text);

        $this->getHeadline()->shouldReturn("headline");
        $this->getAbout()->shouldReturn("about");
        $this->getText()->shouldReturn("text");
    }

    public function it_should_be_edited()
    {
        $this->headline = "headline 2";
        $this->about    = "about 2";
        $this->text     = "text 2";

        $this->write($this->headline, $this->about, $this->text);

        $this->getHeadline()->shouldReturn("headline 2");
        $this->getAbout()->shouldReturn("about 2");
        $this->getText()->shouldReturn("text 2");
    }

    public function it_sould_be_published()
    {
        $this->publish(new \DateTime());

        $this->shouldBePublished();
    }

    public function it_should_be_depublished()
    {
        $this->depublish();

        $this->shouldNotBePublished();
    }
}
