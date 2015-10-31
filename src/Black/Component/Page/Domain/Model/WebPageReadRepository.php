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
 * Interface WebPageReadRepository
 */
interface WebPageReadRepository
{
    public function findAll();

    public function find(WebPageId $id);

    public function findBySlug($slug);
}
