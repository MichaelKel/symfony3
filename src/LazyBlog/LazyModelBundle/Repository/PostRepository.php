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
    public function findFirst()
    {
        $qb = $this->getQueryBuilder()
            ->orderBy('p.id', 'asc')
            ->setMaxResults(1);

        return $qb->getQuery()->getSingleResult();
    }

    /**
     * Найти теги
     *
     * @return array
     */
    public function getTags()
    {
        $blogTags = $this->createQueryBuilder('b')
            ->select('b.tags')
            ->getQuery()
            ->getResult();

        $tags = array();

        foreach ($blogTags as $blogTag)
        {
            $tags = array_merge(explode(",", $blogTag['tags']), $tags);
        }

        foreach ($tags as &$tag)
        {
            $tag = trim($tag);
        }

        return $tags;
    }

    /**
     *
     *
     * @param $tags
     *
     * @return array
     */
    public function getTagWeights($tags)
    {
        $tagWeights = array();
        if (empty($tags))
            return $tagWeights;

        foreach ($tags as $tag)
        {
            $tagWeights[$tag] = (isset($tagWeights[$tag])) ? $tagWeights[$tag] + 1 : 1;
        }
        // Shuffle the tags
        uksort($tagWeights, function() {
            return rand() > rand();
        });

        $max = max($tagWeights);

        // Max of 5 weights
        $multiplier = ($max > 5) ? 5 / $max : 1;
        foreach ($tagWeights as &$tag)
        {
            $tag = ceil($tag * $multiplier);
        }

        return $tagWeights;
    }
}