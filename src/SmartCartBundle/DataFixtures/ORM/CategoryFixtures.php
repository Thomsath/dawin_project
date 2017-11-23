<?php

namespace SmartCartBundle\DataFixtures\ORM;

use SmartCartBundle\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 10; $i < 12; $i++) {
            $category = new Category();
            $category->setName('Category '.$i);
            $manager->persist($category);
        }

        $manager->flush();
    }
}
