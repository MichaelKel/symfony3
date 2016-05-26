<?php

namespace LazyBlog\LazyModelBundle\Repository;

use Doctrine\ORM\EntityRepository;
use LazyBlog\LazyModelBundle\Entity\User;

class UserRepository extends EntityRepository
{
    /**
     * @return User
     */
    public function findFirst()
    {
        $qb = $this->getQueryBuilder()
            ->orderBy('u.id', 'asc')
            ->setMaxResults(1);


        return $qb->getQuery()->getSingleResult();
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