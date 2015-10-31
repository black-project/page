<?php
/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Black\Component\Page\Application\Service;

use Black\Component\Common\Application\Specification\Specification;
use Black\Component\Page\Application\DTO\WebPageAssembler;
use Black\Component\Page\Application\DTO\WebPageDTO;
use Black\Component\Page\Application\Specification\PageIsPublishedSpecification;
use Black\Component\Page\Domain\Model\WebPage;
use Black\Component\Page\Infrastructure\Service\WebPageReadService as InfrastructureService;

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

    private function checkSatisfaction(WebPage $page)
    {
        if (true === $this->specification->isSatisfiedBy($page)) {
            $dto = $this->assembler->transform($page);
            return $dto;
        }
    }
}
