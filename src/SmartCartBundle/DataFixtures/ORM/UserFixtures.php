<?php

namespace SmartCartBundle\DataFixtures\ORM;

use SmartCartBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i < 32; $i++) {
            $user = new User();
            $user->setUsername('username'.$i);
            $user->setEmail('username'.$i.'@mail.local');

            $encoder = $this->container->get('security.password_encoder');
            $password = $encoder->encodePassword($user, 'password'.$i);
            $user->setPassword($password);

            $manager->persist($user);
        }

        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('admin@mail.local');
        $encoder = $this->container->get('security.password_encoder');
        $password = $encoder->encodePassword($user, 'admin');
        $user->setPassword($password);

        $manager->persist($user);

        $manager->flush();
    }
}
