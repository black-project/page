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
use Black\DDD\DDDinPHP\Application\Service\ApplicationService;
use Black\DDD\DDDinPHP\Application\Specification\Specification;
use Black\DDD\DDDinPHP\Infrastructure\Service\InfrastructureService;

class WebPageReadService implements ApplicationService
{
    /**
     * @var \Black\DDD\DDDinPHP\Application\Specification\Specification
     */
    protected $specification;

    /**
     * @var \Black\DDD\DDDinPHP\Infrastructure\Service\InfrastructureService
     */
    protected $service;

    /**
     * @var \Black\Component\Page\Application\DTO\WebPageTransformer
     */
    protected $transformer;

    /**
     * @param Specification $specification
     * @param InfrastructureService $service
     * @param WebPageTransformer $transformer
     */
    public function __construct(
        Specification $specification,
        InfrastructureService $service,
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