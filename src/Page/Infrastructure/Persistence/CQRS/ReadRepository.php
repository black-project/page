<?php

namespace Black\Page\Infrastructure\Persistence\CQRS;

use Black\Page\Domain\Model\WebPageId;
use Black\Page\Domain\Model\WebPageRepository;

class ReadRepository
{
    protected $repository;

    public function __construct(WebPageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function find(WebPageId $id)
    {
        return $this->repository->find($id);
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }
}
