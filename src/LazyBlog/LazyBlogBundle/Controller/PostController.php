<?php

namespace LazyBlog\LazyBlogBundle\Controller;

use LazyBlog\LazyModelBundle\Entity\Comment;
use LazyBlog\LazyModelBundle\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation;

/**
 * Class PostController
 */
class PostController extends Controller
{
    /**
     * max latest posts view
     */
    const MAX_LATEST_POSTS = 1;

    /**
     * Вывести все посты
     *
     * @return array
     *
     * @Route("/blog")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()
            ->getManager();

        $tags = $em->getRepository('LazyModelBundle:Post')
            ->getTags();

        $tagWeights = $em->getRepository('LazyModelBundle:Post')
            ->getTagWeights($tags);


        $posts = $this->getDoctrine()->getRepository('LazyModelBundle:Post')->findAll();

        $latestPosts = $this->getDoctrine()->getRepository('LazyModelBundle:Post')->findLasted(self::MAX_LATEST_POSTS);

        return array(
            'posts' => $posts,
            'latestPosts' => $latestPosts,
            'tagWeights' => $tagWeights,
            'tags' => $tags
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
     * @Template("LazyBlogBundle:Post:show.html.twig")
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

        $form = $this->createForm(CommentType::class);

        return array(
            'post' => $post,
            'form' => $form->createView()
        );
    }

    /**
     * @param Request $request
     * @param $slug
     *
     * @return array
     *
     * @Route("/{slug}/create-comment")
     * @Method("POST")
     * @Template("LazyBlogBundle:Post:show.html.twig")
     */
    public function createCommentAction(Request $request, $slug)
    {
        $post = $this->getDoctrine()->getRepository('LazyModelBundle:Post')->findOneBy(
          array(
              'slug' => $slug,
          )
        );

        if(null === $post) {
            throw $this->createNotFoundException('Пост ненайден');
        }

        $comment = new Comment();
        $comment->setPost($post);

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if($form->isValid()) {
            $this->getDoctrine()->getManager()->persist($comment);
            $this->getDoctrine()->getManager()->flush();

            $this->get('session')->getFlashBag()->add('success','Your comment was submitted sucessfully');

            return $this->redirectToRoute('lazyblog_lazyblog_post_show',
                array(
                    'slug' => $slug,
                )
            );
        }

        return array(
            'post' => $post,
            'form' => $form->createView()
        );
    }

}