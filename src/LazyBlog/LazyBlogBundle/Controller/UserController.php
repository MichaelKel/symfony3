<?php

namespace LazyBlog\LazyBlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class UserController extends Controller
{
    /**
     * @param string $slug
     *
     * @throws MotFoundException
     *
     * @return array
     *
     * @Route("/user/{slug}")
     */
    public function showAction($slug)
    {
        $user = $this->getDoctrine()->getRepository('LazyModelBundle:User')->findOneBy(
            array(
                'slug' => $slug,
            )
        );

        if (null === $user) {
            throw $this->createNotFoundException("Пользователь ненайден");
        }

        $posts = $this->getDoctrine()->getRepository('LazyModelBundle:Post')->findBy(
            array(
                'user' => $user,
            )
        );

            return $this->render('LazyBlogBundle:User:show.html.twig',
                array(
                    'user' => $user,
                    'posts' => $posts,
                    'slug' => $slug,
            ));
    }

}
