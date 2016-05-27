<?php

namespace LazyBlog\LazyModelBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use LazyBlog\LazyModelBundle\Entity\Comment;

class Comments extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 20;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $posts = $manager->getRepository('LazyModelBundle:Post')->findAll();

        $comments = array(
            0 => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
            industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled
            it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic
            typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
            sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker
            including versions of Lorem Ipsum.',

            1 => 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text,
            and a search for (lorem ipsum) will uncover many web sites still in their infancy. Various versions have evolved
            over the years, sometimes by accident, sometimes on purpose (injected humour and the like).',

            2 => 'All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making
            this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a
            handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.',
        );

        // Инкрементор для цикла
        $i = 0;

        foreach($posts as $post)
        {
            $comment = new Comment();
            $comment->setUserName('Allah Ibn Hattab');
            $comment->setBody($comments[$i++]);
            /** @var Comment $post */
            $comment->setPost($this->getPost($manager));

            $manager->persist($comment);

            $manager->flush();

        }
    }

    private function getPost(ObjectManager $manager, $post)
    {

        return $manager->getRepository('LazyModelBundle:User')->findOneBy(
            array(
                'post' => $post,
            )
        );

    }

}