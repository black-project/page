<?php

namespace Black\Page\Domain\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Class WebPageWritedEvent
 */
final class WebPageWritedEvent extends Event
{
    /**
     * @var
     */
    private $webPageId;

    /**
     * @var
     */
    private $name;

    /**
     * @param $webPageId
     * @param $name
     */
    public function __construct($webPageId, $name)
    {
        $this->webPageId = $webPageId;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function message()
    {
        return "The page {$this->name} was successfully write for {$this->webPageId} identifier";
    }
}
