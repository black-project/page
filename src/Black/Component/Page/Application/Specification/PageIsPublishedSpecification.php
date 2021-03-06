<?php
/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Black\Component\Page\Application\Specification;

use Black\Component\Page\Domain\Model\WebPage;

/**
 * Class PageIsPublishedSpecification
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
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
