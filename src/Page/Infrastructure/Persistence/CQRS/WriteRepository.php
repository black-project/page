<?php

namespace Black\Website\Infrastructure\Persistence\CQRS;

use Black\Page\Domain\Model\WebPage;
use Black\Page\Domain\Model\WebPageRepository;

class WriteRepository
{
    protected $repository;

    public function __construct(WebPageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function add(WebPage $webpage)
    {
        $this->repository->add($webpage);
    }

    public function update(WebPage $webpage)
    {
        $this->repository->update($webpage);
    }
}
