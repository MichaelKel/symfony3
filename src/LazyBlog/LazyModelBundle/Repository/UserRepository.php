<?php

namespace LazyBlog\LazyModelBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    /**
     * @return mixed
     */
    public function findFirst()
    {
        $result = '';
        $qb = $this->getQueryBuilder()
            ->orderBy('u.id', 'asc')
            ->setMaxResults(1);

        $result = $qb->getQuery()->getSingleResult();

//        if ($result === null) {
//        }

        return $result;
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    private function getQueryBuilder()
    {
        $em = $this->getEntityManager();

        $qb = $em->getRepository('LazyModelBundle:User')
            ->createQueryBuilder('u');

        return $qb;
    }
}