<?php

namespace Black\Page\Application\Service;

use Black\Component\Common\Application\Specification\Specification;
use Black\Page\Application\DTO\WebPageAssembler;
use Black\Page\Application\DTO\WebPageDTO;
use Black\Page\Application\Specification\PageIsPublishedSpecification;
use Black\Page\Domain\Model\WebPage;
use Black\Page\Infrastructure\Service\WebPageReadService as InfrastructureService;

class WebPageReadService
{
    /**
     * @var Specification
     */
    protected $specification;

    /**
     * @var InfrastructureService
     */
    protected $service;

    /**
     * @var
     */
    protected $transformer;

    /**
     * @param PageIsPublishedSpecification $specification
     * @param InfrastructureService $service
     * @param WebPageAssembler $assembler
     */
    public function __construct(
        PageIsPublishedSpecification $specification,
        InfrastructureService $service,
        WebPageAssembler $assembler
    ) {
        $this->specification = $specification;
        $this->service       = $service;
        $this->assembler   = $assembler;
    }

    /**
     * @param $id
     *
     * @return WebPageDTO
     */
    public function read($id)
    {
        $page = $this->service->read($id);

        return $this->checkSatisfaction($page);
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function readBySlug($slug)
    {
        $page = $this->service->readBySlug($slug);

        return $this->checkSatisfaction($page);
    }

    /**
     * @param WebPage $page
     * @return mixed
     */
    private function checkSatisfaction(WebPage $page)
    {
        if (true === $this->specification->isSatisfiedBy($page)) {
            $dto = $this->assembler->transform($page);
            return $dto;
        }
    }
}
