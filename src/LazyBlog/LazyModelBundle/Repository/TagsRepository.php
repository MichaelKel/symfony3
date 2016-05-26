<?php

namespace LazyBlog\LazyModelBundle\Repository;

/**
 * TagsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
use Doctrine\ORM\EntityRepository;

class TagsRepository extends EntityRepository
{
    /**
     * @var string $result
     *
     * @return Tags
     */
    public function findId($id)
    {
        $qb = $this->getQueryBuilder()
            ->orderBy('t.id')
            ->setMaxResults($id);

        return $qb->getQuery()->getSingleResult();
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    private function getQueryBuilder()
    {
        $em = $this->getEntityManager();

        $qb = $em->getRepository('LazyModelBundle:Tags')
            ->createQueryBuilder('t');

        return $qb;
    }
}
