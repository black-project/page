<?php

namespace Black\Page\Infrastructure\Persistence\ORM;

use Black\Component\Common\Infrastructure\Persistence\ORM\EntityRepository;
use Black\Page\Domain\Model\WebPageId;
use Black\Page\Domain\Model\WebPageReadRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\NoResultException;

/**
 * Class ReadRepository
 */
class ReadRepository extends EntityRepository implements WebPageReadRepository
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
            ->where('p.webPageId.value = :id')
            ->setParameter('id', $id->getValue())
            ->getQuery();

        try {
            return $query->getSingleResult();
        } catch (NoResultException $exception) {
            return null;
        }
    }

    /**
     * @param $slug
     * @return mixed|null
     */
    public function findBySlug($slug)
    {
        $query = $this->getQueryBuilder()
            ->where('p.slug = :slug')
            ->setParameter('slug', $slug)
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
        return $this->getQueryBuilder()->getQuery()->execute();
    }
}
