<?php

namespace Black\Page\Domain\Model;

/**
 * Interface WebPageWriteRepository
 */
interface WebPageWriteRepository
{
    public function add(WebPage $webPage);

    public function remove(WebPage $webPage);
}
