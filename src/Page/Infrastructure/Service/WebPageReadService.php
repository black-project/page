<?php

namespace Black\Page\Infrastructure\Service;

use Black\Page\Domain\Exception\WebPageNotFoundException;
use Black\Page\Domain\Model\WebPageId;
use Black\Page\Infrastructure\Persistence\CQRS\ReadRepository;

class WebPageReadService
{
    /**
     * @var ReadRepository
     */
    protected $repository;

    /**
     * WebPageReadService constructor.
     *
     * @param ReadRepository $repository
     */
    public function __construct(ReadRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param WebPageId $webPageId
     * @return mixed
     */
    public function read(WebPageId $webPageId)
    {
        $page = $this->repository->find($webPageId);

        if (null === $page) {
            throw new WebPageNotFoundException();
        }

        return $page;
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function readBySlug($slug)
    {
        $page = $this->repository->findBySlug($slug);

        if (null === $page) {
            throw new WebPageNotFoundException();
        }

        return $page;
    }

    /**
     * @return mixed
     */
    public function listAllPages()
    {
        return $this->repository->findAll();
    }

}
