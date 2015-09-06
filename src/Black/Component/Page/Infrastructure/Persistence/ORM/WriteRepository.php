<?php

namespace Black\Component\Page\Infrastructure\Persistence\ORM;

use Black\Component\Common\Infrastructure\Persistence\ORM\EntityRepository;
use Black\Component\Page\Domain\Model\WebPageWriteRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Black\Component\Page\Domain\Model\WebPage;
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
     *
     */
    public function flush()
    {
        $this->manager->flush();
    }
}
