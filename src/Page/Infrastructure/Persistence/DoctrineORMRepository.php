<?php

namespace Black\Page\Infrastructure\Persistence;

use Black\Bridge\Doctrine\Common\Persistence\ORMRepository;
use Black\Page\Domain\Model\WebPage;
use Black\Page\Domain\Model\WebPageId;
use Black\Page\Domain\Model\WebPageRepository;
use Doctrine\ORM\NoResultException;

/**
 * Class DoctrineORMRepository
 */
class DoctrineORMRepository extends ORMRepository implements WebPageRepository
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

    /**
     * @param WebPage $webpage
     */
    public function add(WebPage $webpage)
    {
        $this->manager->persist($webpage);
        $this->update($webpage);
    }

    /**
     * @param WebPage $webpage
     */
    public function remove(WebPage $webpage)
    {
        $this->manager->remove($webpage);
        $this->update($webpage);

    }

    public function update(WebPage $webpage)
    {
        $this->manager->flush();
    }
}
