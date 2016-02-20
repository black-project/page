<?php

namespace Black\Page\Domain\Model;

/**
 * Interface WebPageRepository
 */
interface WebPageRepository
{
    public function findAll();

    public function find(WebPageId $id);

    public function findBySlug($slug);

    public function add(WebPage $webPage);

    public function remove(WebPage $webPage);

    public function update(WebPage $webPage);

    public function getClassName() : string;
}
