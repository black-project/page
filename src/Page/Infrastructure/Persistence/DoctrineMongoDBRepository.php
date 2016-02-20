<?php

namespace Black\Page\Infrastructure\Persistence;

use Black\Bridge\Doctrine\Common\Persistence\MongoDB\MongoDBRepository;
use Black\Bridge\Doctrine\Common\Persistence\ORMRepository;
use Black\Page\Domain\Model\WebPage;
use Black\Page\Domain\Model\WebPageId;
use Black\Page\Domain\Model\WebPageRepository;
use Doctrine\ORM\NoResultException;

/**
 * Class DoctrineMongoDBRepository
 */
class DoctrineMongoDBRepository extends MongoDBRepository implements WebPageRepository
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
