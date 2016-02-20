<?php

namespace Black\Page\Application\Specification;

use Black\Page\Domain\Model\WebPage;

/**
 * Class PageIsPublishedSpecification
 */
final class PageIsPublishedSpecification
{
    /**
     * @param WebPage $webPage
     *
     * @return bool
     */
    public function isSatisfiedBy(WebPage $webPage)
    {
        return (bool) true === $webPage->isPublished();
    }
}
