<?php

namespace Black\Page\Infrastructure\Persistence\ORM;

use Black\Component\Common\Infrastructure\Persistence\ORM\EntityRepository;
use Black\Page\Domain\Model\WebPageWriteRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Black\Page\Domain\Model\WebPage;
use Doctrine\ORM\NoResultException;

/**
 * Class WriteRepository
 */
class WriteRepository extends EntityRepository implements WebPageWriteRepository
{
    /**
     * @param WebPage $website
     */
    public function add(WebPage $website)
    {
        $this->manager->persist($website);
    }

    /**
     * @param WebPage $website
     */
    public function remove(WebPage $website)
    {
        $this->manager->remove($website);
    }

    /**
     * Flushes all changes to objects that have been queued up to now to the database.
     * This effectively synchronizes the in-memory state of managed objects with the
     * database.
     */
    public function flush()
    {
        $this->manager->flush();
    }
}
