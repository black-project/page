<?php

namespace Black\Page\Infrastructure\Persistence\CQRS;

use Black\Page\Domain\Model\WebPage;
use Black\Page\Domain\Model\WebPageRepository;

/**
 * Class WriteRepository
 */
class WriteRepository
{
    /**
     * @var WebPageRepository
     */
    protected $repository;

    /**
     * WriteRepository constructor.
     *
     * @param WebPageRepository $repository
     */
    public function __construct(WebPageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param WebPage $webpage
     */
    public function add(WebPage $webpage)
    {
        $this->repository->add($webpage);
    }

    /**
     * @param WebPage $webpage
     */
    public function update(WebPage $webpage)
    {
        $this->repository->update($webpage);
    }
}
