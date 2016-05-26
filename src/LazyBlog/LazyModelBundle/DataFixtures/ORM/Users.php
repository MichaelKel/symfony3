<?php

namespace LazyBlog\LazyModelBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use LazyBlog\LazyModelBundle\Entity\User;

/**
 * Class Users(fixtures for the Users Entity)
 */
class Users extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 10;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setName('Дмитрий');
        $user1->setEmail('qwe@mail.ru');
        $user1->setPassword('1');
        $user1->setRole('admin');

        $user2 = new User();
        $user2->setName('Алексей');
        $user2->setEmail('q@mail.ru');
        $user2->setPassword('12');
        $user2->setRole('client');

        $user3 = new User();
        $user3->setName('Михаил');
        $user3->setEmail('qwe@mail.ru');
        $user3->setPassword('123');
        $user3->setRole('client');

        $user4 = new User();
        $user4->setName('Юрий');
        $user4->setEmail('qw@mail.ru');
        $user4->setPassword('1234');
        $user4->setRole('client');

        $user5 = new User();
        $user5->setName('Владимир');
        $user5->setEmail('qwer@mail.ru');
        $user5->setPassword('12345');
        $user5->setRole('client');

        $user6 = new User();
        $user6->setName('Анатолий');
        $user6->setEmail('qwert@mail.ru');
        $user6->setPassword('123456');
        $user6->setRole('client');

        $user7 = new User();
        $user7->setName('Александр');
        $user7->setEmail('qwerty@mail.ru');
        $user7->setPassword('1234567');
        $user7->setRole('client');

        $user8 = new User();
        $user8->setName('Алиса');
        $user8->setEmail('qwertyu@mail.ru');
        $user8->setPassword('12345678');
        $user8->setRole('client');

        $user9 = new User();
        $user9->setName('Жанна');
        $user9->setEmail('qwertyui@mail.ru');
        $user9->setPassword('123456789');
        $user9->setRole('client');

        $user10 = new User();
        $user10->setName('Евгений');
        $user10->setEmail('qwertyuio@mail.ru');
        $user10->setPassword('12345678910');
        $user10->setRole('client');

        $manager->persist($user1);
        $manager->persist($user2);
        $manager->persist($user3);
        $manager->persist($user4);
        $manager->persist($user5);
        $manager->persist($user6);
        $manager->persist($user7);
        $manager->persist($user8);
        $manager->persist($user9);
        $manager->persist($user10);

        $manager->flush();


    }
}