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

use Black\Component\Page\Application\DTO\WebPageDTO;
use Black\Component\Page\Application\DTO\WebPageTransformer;
use Black\DDD\DDDinPHP\Application\Service\ApplicationServiceInterface;
use Black\DDD\DDDinPHP\Application\Specification\SpecificationInterface;
use Black\DDD\DDDinPHP\Infrastructure\Service\InfrastructureServiceInterface;

class WebPageReadService implements ApplicationServiceInterface
{
    /**
     * @var \Black\DDD\DDDinPHP\Application\Specification\SpecificationInterface
     */
    protected $specification;

    /**
     * @var \Black\DDD\DDDinPHP\Infrastructure\Service\InfrastructureServiceInterface
     */
    protected $service;

    /**
     * @var \Black\Component\Page\Application\DTO\WebPageTransformer
     */
    protected $transformer;

    /**
     * @param SpecificationInterface $specification
     * @param InfrastructureServiceInterface $service
     * @param WebPageTransformer $transformer
     */
    public function __construct(
        SpecificationInterface $specification,
        InfrastructureServiceInterface $service,
        WebPageTransformer $transformer
    ) {
        $this->specification = $specification;
        $this->service       = $service;
        $this->transformer   = $transformer;
    }

    /**
     * @param $id
     *
     * @return WebPageDTO
     */
    public function read($id)
    {
        $page = $this->service->read($id);

        if ($this->specification->isSatisfiedBy($page)) {

            $dto = $this->transformer->transform($page);

            return $dto;
        }
    }
} 