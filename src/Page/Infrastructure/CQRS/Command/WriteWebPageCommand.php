<?php

namespace Black\Page\Infrastructure\CQRS\Command;

use Black\Page\Domain\Model\WebPageId;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Command;

/**
 * Class WriteWebPageCommand
 */
final class WriteWebPageCommand implements Command
{
    /**
     * @var WebPageId
     */
    private $webPageId;

    /**
     * @var
     */
    private $headline;

    /**
     * @var
     */
    private $about;

    /**
     * @var
     */
    private $text;

    /**
     * WriteWebPageCommand constructor.
     *
     * @param WebPageId $webPageId
     * @param $headline
     * @param $about
     * @param $text
     */
    public function __construct(WebPageId $webPageId, $headline, $about, $text)
    {
        $this->webPageId = $webPageId;
        $this->headline = $headline;
        $this->about = $about;
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getWebPageId()
    {
        return $this->webPageId;
    }

    /**
     * @return mixed
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * @return mixed
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }
}
