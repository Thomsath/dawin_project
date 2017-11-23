<?php

namespace SmartCartBundle\DataFixtures\ORM;

use SmartCartBundle\Entity\Cart;
use SmartCartBundle\Entity\CartProduct;
use SmartCartBundle\Entity\Review;
use SmartCartBundle\Entity\User;
use SmartCartBundle\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Fixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($c=1; $c < 8; $c++) {
            $category = new Category();
            $category->setName('Category '.$c);

            for ($i = 1; $i < mt_rand(8,16); $i++) {
                $cart = new Cart();
                $cart->setName('Cart '.$i);
                $cart->setDescription('Cart '.$i.' description');
                $cart->setQuantity(mt_rand(10,100));
                $cart->setPrice(mt_rand(2,50));
                $cart->setImage('http://image'.$i.'.org/');

                for ($u=1; $u < mt_rand(0,4); $u++) {
                    $cartProduct = new CartProduct();
                    $cartProduct->setCart($cart);
                    $cartProduct->setProductId("2GEQ4".$u.$i);
                    $cartProduct->setQuantity(mt_rand(0,64));

                    $cart->addProduct($cartProduct);
                }

                for ($u=1; $u < mt_rand(0,5); $u++) {
                    $review = new Review();
                    $review->setText("Review ".$u);
                    $review->setRating(mt_rand(0,5));
                    $review->setCart($cart);

                    $manager->persist($review);

                    $userId = $c.$i.$u;

                    $user = new User();
                    $user->setUsername('username'.$userId);
                    $user->setEmail('username'.$userId.'@mail.local');

                    $encoder = $this->container->get('security.password_encoder');
                    $password = $encoder->encodePassword($user, 'password'.$userId);
                    $user->setPassword($password);

                    $user->addReview($review);

                    $manager->persist($user);
                }

                $manager->persist($cart);
                $category->addCart($cart);
            }

            $manager->persist($category);
        }

        $manager->flush();
    }
}
