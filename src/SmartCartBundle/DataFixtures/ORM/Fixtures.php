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
        $productIdList = $productIdListHistory = ["ASUSZ300M6A037A","bunnikd3100ktat4","MD513NFA","ASU4712900508604","ASUZ301M1D021A","Z170C1L020A",
        "ASUST101HAGR030T","ASUF541SCXX165T","ASUF751NATY018T","E402WAGA002T","ASUE402NAGA226T","ASU4712900361957","90YH0091M8UA00","ASU4716659439516",
        "ASU4716659893424","XONARU5","OCC7OYZ53674QCJ","CE5000RJ4","TLEC505EM","AUC0065030849906","GOO0811571016686","TLEC530EM"];

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

                for ($u=1; $u < mt_rand(2,9); $u++) {
                    $cartProduct = new CartProduct();
                    $cartProduct->setCart($cart);

                    $productIdIndex = mt_rand(0,count($productIdList)-1);

                    $productId = $productIdList[$productIdIndex];
                    unset($productIdList[$productIdIndex]);
                    $productIdList = array_values($productIdList);

                    $cartProduct->setProductId($productId);
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

                $productIdList = $productIdListHistory;
            }

            $manager->persist($category);
        }

        $manager->flush();
    }
}
