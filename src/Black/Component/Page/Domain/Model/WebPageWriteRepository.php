<?php
/*
 * This file is part of the ${FILE_HEADER_PACKAGE}.
 *
 * ${FILE_HEADER_COPYRIGHT}
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Black\Component\Page\Domain\Model;

/**
 * Interface WebPageWriteRepository
 */
interface WebPageWriteRepository
{
    public function add(WebPage $webPage);

    public function remove(WebPage $webPage);
}
