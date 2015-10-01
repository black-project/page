<?php
/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Black\Component\Page\Infrastructure\CQRS\Handler;

use Black\Component\Page\Domain\Model\WebPageWriteRepository;
use Black\Component\Page\Infrastructure\CQRS\Command\CreateWebPageCommand;
use Black\Component\Page\Domain\Event\WebPageCreatedEvent;
use Black\Component\Page\Infrastructure\Service\WebPageWriteService;
use Black\Component\Page\WebPageDomainEvents;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class CreateWebPageHandler
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
final class CreateWebPageHandler implements CommandHandler
{
    /**
     * @var WebPageWriteService
     */
    protected $service;

    /**
     * @var WebPageWriteRepository
     */
    protected $repository;

    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * @param WebPageWriteService $service
     * @param WebPageWriteRepository $repository
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        WebPageWriteService $service,
        WebPageWriteRepository $repository,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->service         = $service;
        $this->repository      = $repository;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param  CreateWebPageCommand $command
     * @return mixed
     */
    public function handle(CreateWebPageCommand $command)
    {
        $page = $this->service->create($command->getWebPageId(), $command->getAuthor(), $command->getName());
        $this->repository->flush();

        $event = new WebPageCreatedEvent($page->getWebPageId()->getValue(), $page->getName(), $page->getDateCreated());
        $this->eventDispatcher->dispatch(WebPageDomainEvents::WEBPAGE_DOMAIN_CREATED, $event);
    }
}
