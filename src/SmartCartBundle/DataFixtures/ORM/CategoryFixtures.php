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
            $category->setName('Catégorie '.$i);
            $category->setIcon('home');
            $manager->persist($category);

            $r = rand(1,5);
            for ($u = 0; $u < $r; $u++) {
                $cat = new Category();
                $cat->setName('Sous-Catégorie '.$i.'-'.$u);
                $cat->setCategory($category);

                $manager->persist($cat);
            }
        }

        $manager->flush();
    }
}
