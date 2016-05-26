<?php

namespace LazyBlog\LazyModelBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use LazyBlog\LazyModelBundle\Entity\Post;
use LazyBlog\LazyModelBundle\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Posts (fixtures for Post Entity)
 */
class Posts extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 15;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $post1 = new Post();
        $post1->setTitle('First post');

        $post1->setBody('This section introduces one of the greatest and most powerful features of Symfony, the bundle system.
A bundle is kind of like a plugin in other software. So why is it called a bundle and not a plugin? This is
because everything is a bundle in Symfony, from the core framework features to the code you write for
your application.
All the code you write for your application is organized in bundles. In Symfony speak, a bundle is a
structured set of files (PHP files, stylesheets, JavaScripts, images, ...) that implements a single feature (a
blog, a forum, ...) and which can be easily shared with other developers.
Bundles are first-class citizens in Symfony. This gives you the flexibility to use pre-built features packaged
in third-party bundles or to distribute your own bundles. It makes it easy to pick and choose which
features to enable in your application and optimize them the way you want. And at the end of the day,
your application code is just as important as the core framework itself.
Symfony already includes an AppBundle that you may use to start developing your application. Then, if
you need to split the application into reusable components, you can create your own bundles.');

        $post1->setTags('Symfony2');
        $post1->setUser($this->getUser($manager, 'Дмитрий'));
        $post1->setCreatedAt(new \DateTime('now'));

        $post2 = new Post();
        $post2->setTitle('Second post');

        $post2->setBody('Odds are that your application will depend on third-party libraries. Those should be stored in the
vendor/ directory. You should never touch anything in this directory, because it is exclusively managed
by Composer. This directory already contains the Symfony libraries, the SwiftMailer library, the Doctrine
ORM, the Twig templating system and some other third party libraries and bundles.');

        $post2->setTags('Symfony3');
        $post2->setUser($this->getUser($manager, 'Алексей'));
        $post2->setCreatedAt(new \DateTime('now'));


        $post3 = new Post();
        $post3->setTitle('Third post');

        $post3->setBody('Symfony applications can contain several configuration files defined in several formats (YAML, XML,
PHP, etc.) Instead of parsing and combining all those files for each request, Symfony uses its own cache
system. In fact, the application configuration is only parsed for the very first request and then compiled
down to plain PHP code stored in the app/cache/ directory.');

        $post3->setTags('php');
        $post3->setUser($this->getUser($manager, 'Алексей'));
        $post3->setCreatedAt(new \DateTime('now'));


        $post4 = new Post();
        $post4->setTitle('Other post');

        $post4->setBody('This section introduces one of the greatest and most powerful features of Symfony, the bundle system.
A bundle is kind of like a plugin in other software. So why is it called a bundle and not a plugin? This is
because everything is a bundle in Symfony, from the core framework features to the code you write for
your application.
All the code you write for your application is organized in bundles. In Symfony speak, a bundle is a
structured set of files (PHP files, stylesheets, JavaScripts, images, ...) that implements a single feature (a
blog, a forum, ...) and which can be easily shared with other developers.
Bundles are first-class citizens in Symfony. This gives you the flexibility to use pre-built features packaged
in third-party bundles or to distribute your own bundles. It makes it easy to pick and choose which
features to enable in your application and optimize them the way you want. And at the end of the day,
your application code is just as important as the core framework itself.
Symfony already includes an AppBundle that you may use to start developing your application. Then, if
you need to split the application into reusable components, you can create your own bundles.');

        $post4->setTags('java');
        $post4->setUser($this->getUser($manager, 'Михаил'));
        $post4->setCreatedAt(new \DateTime('now'));

        $manager->persist($post1);
        $manager->persist($post2);
        $manager->persist($post3);
        $manager->persist($post4);

        $manager->flush();

    }

    /**
     * Получить пользователей
     *
     * @param ObjectManager $manager
     * @param string $name
     *
     * @return User
     */
    private function getUser(ObjectManager $manager, $name)
    {
        return $manager->getRepository('LazyModelBundle:User')->findOneBy(
            array(
                'name' => $name,
            )
        );
    }

}