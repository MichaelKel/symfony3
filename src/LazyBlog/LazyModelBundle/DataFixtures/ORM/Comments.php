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
        $comments = array(
            1 => 'c',
            2 => 'a',
            3 => 'b',
            4 => 'b',
            5 => 'b',
        );

        for ($i = 1; $i < 6; $i++) {
            $comment = new Comment();
            $comment->setUserName('Allah Ibn Hattab');
            $comment->setBody($comments[rand(1, 5)]);
            $comment->setPost($this->getReference('my_post'.$i));
            $manager->persist($comment);
        }
        $manager->flush();
    }


}