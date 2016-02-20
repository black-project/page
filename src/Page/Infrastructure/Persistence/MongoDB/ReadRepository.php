<?php

namespace Black\Page\Infrastructure\Persistence\MongoDB;

use Black\Component\Common\Infrastructure\Persistence\MongoDB\DocumentRepository;
use Black\Page\Domain\Model\WebPageId;
use Black\Page\Domain\Model\WebPageReadRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\NoResultException;

/**
 * Class ReadRepository
 */
class ReadRepository extends DocumentRepository implements WebPageReadRepository
{
    /**
     * @param mixed $id
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function find(WebPageId $id)
    {
        $query = $this->getQueryBuilder()
            ->field('webPageId.value')->equals($id->getValue())
            ->getQuery();

        try {
            return $query->getSingleResult();
        } catch (NoResultException $exception) {
            return null;
        }
    }

    public function findBySlug($slug)
    {
        $query = $this->getQueryBuilder()
            ->field('slug')->equals($slug)
            ->getQuery();

        try {
            return $query->getSingleResult();
        } catch (NoResultException $exception) {
            return null;
        }
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->getQueryBuilder()->getQuery();
    }
}
