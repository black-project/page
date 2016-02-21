<?php

namespace Black\Page\Infrastructure\Persistence\CQRS;

use Black\Page\Domain\Model\WebPageId;
use Black\Page\Domain\Model\WebPageRepository;

/**
 * Class ReadRepository
 */
class ReadRepository
{
    /**
     * @var WebPageRepository
     */
    protected $repository;

    /**
     * ReadRepository constructor.
     *
     * @param WebPageRepository $repository
     */
    public function __construct(WebPageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param WebPageId $id
     * @return mixed
     */
    public function find(WebPageId $id)
    {
        return $this->repository->find($id);
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->repository->findAll();
    }
}
