<?php

namespace LazyBlog\LazyBlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use  Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class PostController
 */
class PostController extends Controller
{
    /**
     * max latest posts view
     */
    const MAX_LATEST_POSTS = 3;

    /**
     * Вывести все посты
     *
     *
     * @Route("/blog")
     * @Template()
     * @return array
     */
    public function indexAction()
    {
        $posts = $this->getDoctrine()->getRepository('LazyModelBundle:Post')->findAll();

        $latestPosts = $this->getDoctrine()->getRepository('LazyModelBundle:Post')->findLasted(self::MAX_LATEST_POSTS);

        return array(
            'posts' => $posts,
            'latestPosts' => $latestPosts,
        );
    }

    /**
     * Показать пост
     *
     * @param string $slug
     *
     * @throws NotFoundHttpException
     *
     * @Route("/{slug}")
     * @Template()
     *
     * @return array
     */
    public function showAction($slug)
    {
        $post = $this->getDoctrine()->getRepository('LazyModelBundle:Post')->findOneBy(
            array(
                'slug' => $slug,
            )
        );

        if (null === $post) {
            throw $this->createNotFoundException('Пост ненайден');
        }

        return array(
            'post' => $post,
        );
    }

}