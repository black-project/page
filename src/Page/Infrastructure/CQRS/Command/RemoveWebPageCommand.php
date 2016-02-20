<?php

namespace Black\Page\Infrastructure\CQRS\Command;

use Black\Page\Domain\Model\WebPage;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Command;

/**
 * Class RemoveWebPageCommand
 */
final class RemoveWebPageCommand implements Command
{
    /**
     * @var
     */
    private $webPage;

    /**
     * @param WebPage $webPage
     */
    public function __construct(WebPage $webPage)
    {
        $this->webPage = $webPage;
    }

    /**
     * @return mixed
     */
    public function getWebPage()
    {
        return $this->webPage;
    }
}
