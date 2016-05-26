<?php

/**
 * Created by PhpStorm.
 * User: fox
 * Date: 24.05.16
 * Time: 12:31
 */

namespace LazyBlog\LazyModelBundle\Repository;

use Doctrine\ORM\EntityRepository;
use LazyBlog\LazyModelBundle\Entity\Post;

/**
 * Class PostRepository
 */
class PostRepository extends EntityRepository
{
    /**
     * Найти последние посты
     *
     * @param int $last
     *
     * @return Post
     */
    public function findLasted($last)
    {
        $qb = $this->getQueryBuilder()
            ->orderBy('p.createdAt', 'desc')
            ->setMaxResults($last);

        return $qb->getQuery()->getResult();
    }

    private function getQueryBuilder()
    {
        $em = $this->getEntityManager();

        $qb = $em->getRepository('LazyModelBundle:Post')->createQueryBuilder('p');

        return $qb;
    }

    /**
     * Найти первый пост
     *
     * @return Post
     */
    public function firstFirst()
    {
        $qb = $this->getQueryBuilder()
            ->orderBy('p.id', 'asc')
            ->setMaxResults(1);

        return $qb->getQuery()->getSingleResult();
    }
}