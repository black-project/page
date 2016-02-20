<?php

namespace Black\Page\Infrastructure\CQRS\Command;

use Black\Page\Domain\Model\WebPageId;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Command;

/**
 * Class CreateWebPageCommand
 */
final class CreateWebPageCommand implements Command
{
    /**
     * @var \Black\Page\Domain\Model\WebPageId
     */
    private $webPageId;

    /**
     * @var
     */
    private $author;

    /**
     * @var
     */
    private $name;

    /**
     * @param WebPageId $webPageId
     * @param $author
     * @param $name
     */
    public function __construct(WebPageId $webPageId, $author, $name)
    {
        $this->webPageId = $webPageId;
        $this->author = $author;
        $this->name = $name;
    }

    /**
     *
     */
    public function getWebPageId()
    {
        return $this->webPageId;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
}
