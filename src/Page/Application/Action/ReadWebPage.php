<?php

namespace Black\Page\Application\Action;

use Black\Page\Application\Service\WebPageReadService;
use Black\Page\Domain\Model\WebPageId;

/**
 * Class ReadWebPage
 */
class ReadWebPage
{
    /**
     * @var WebPageReadService
     */
    protected $service;

    /**
     * @param WebPageReadService $service
     */
    public function __construct(WebPageReadService $service)
    {
        $this->service = $service;
    }

    /**
     * @param WebPageId $id
     * @return \Black\Page\Application\DTO\WebPageDTO
     */
    public function __invoke(WebPageId $id)
    {
        $page = $this->service->read($id);

        return $page;
    }
}
