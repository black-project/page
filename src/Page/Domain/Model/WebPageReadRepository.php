<?php

namespace Black\Page\Domain\Model;

/**
 * Interface WebPageReadRepository
 */
interface WebPageReadRepository
{
    public function findAll();

    public function find(WebPageId $id);

    public function findBySlug($slug);
}
