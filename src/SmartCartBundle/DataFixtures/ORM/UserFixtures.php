<?php

namespace SmartCartBundle\DataFixtures\ORM;

use SmartCartBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('admin@mail.local');
        $encoder = $this->container->get('security.password_encoder');
        $password = $encoder->encodePassword($user, 'admin');
        $user->setPassword($password);
        $user->setEnabled(true);
        $user->addRole("ROLE_ADMIN");

        $manager->persist($user);

        $manager->flush();
    }
}
