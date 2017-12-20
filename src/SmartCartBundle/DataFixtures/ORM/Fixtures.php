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

        $categoryList = ["Maison","Jardin & Bricolage","Informatique","TV & Son","Téléphonie","Sport"];
        $iconList = ["home","wrench","laptop","television","mobile","soccer-ball-o"];

        for ($c=1; $c < count($categoryList); $c++) {

            $categoryName = $categoryList[$c-1];
            $categoryIcon = $iconList[$c-1];

            $category = new Category();
            $category->setName($categoryName);
            $category->setIcon($categoryIcon);
            $manager->persist($category);

            $r = mt_rand(1,5);
            if($r <= 1)
            {
                for ($i = 1; $i < mt_rand(8,count($productIdListHistory)-3); $i++) {
                    $cart = new Cart();
                    $cart->setName('Panier n°'.$c.''.$i);
                    $cart->setDescription('Description du panier n°'.$i);
                    $cart->setQuantity(mt_rand(10,100));
                    $cart->setPrice(mt_rand(2,50));
                    $cart->setImage('http://thecatapi.com/api/images/get?format=src&type=gif&size=med');

                    for ($u=1; $u < mt_rand(3,9); $u++) {
                        $cartProduct = new CartProduct();
                        $cartProduct->setCart($cart);

                        $productIdIndex = mt_rand(0,count($productIdList)-1);

                        $productId = $productIdList[$productIdIndex];
                        unset($productIdList[$productIdIndex]);
                        $productIdList = array_values($productIdList);

                        $cartProduct->setProductId($productId);
                        $cartProduct->setQuantity(mt_rand(0,64));

                        $cart->addProduct($cartProduct);

                        $r = mt_rand(0,3);
                        if($r <= 1)
                        $cart->setLevel('amateur');
                        else if($r <= 2)
                        $cart->setLevel('professionnel');
                        else
                        $cart->setLevel('intermediaire');
                    }

                    for ($u=1; $u < mt_rand(0,5); $u++) {
                        $review = new Review();
                        $review->setTitle("Titre de l'avis ".$u);
                        $review->setText("Contenu de l'avis ".$u);
                        $review->setRating(mt_rand(0,5));
                        $review->setCart($cart);

                        $manager->persist($review);

                        $username = $this->getRandomWord(mt_rand(5,12));

                        $user = new User();
                        $user->setUsername($username);
                        $user->setEmail($username . '@mail.local');

                        $encoder = $this->container->get('security.password_encoder');
                        $password = $encoder->encodePassword($user, $username);
                        $user->setPassword($password);

                        $user->addReview($review);
                        $manager->persist($user);
                    }

                    $manager->persist($cart);
                    $category->addCart($cart);

                    $productIdList = $productIdListHistory;
                }

                $productIdList = $productIdListHistory;
                continue;
            }

            $productIdList = $productIdListHistory;

            for ($g = 1; $g < $r; $g++) {
                $cat = new Category();
                $cat->setName('Sous-Catégorie '.$c.''.$g);
                $cat->setCategory($category);

                for ($i = 1; $i < mt_rand(8,16); $i++) {
                    $cart = new Cart();
                    $cart->setName('Panier n°'.$g.''.$i);
                    $cart->setDescription('Description du panier n°'.$i);
                    $cart->setQuantity(mt_rand(10,100));
                    $cart->setPrice(mt_rand(2,50));
                    $cart->setImage('http://thecatapi.com/api/images/get?format=src&type=gif&size=med');

                    for ($u=1; $u < mt_rand(3,9); $u++) {
                        $cartProduct = new CartProduct();
                        $cartProduct->setCart($cart);

                        $productIdIndex = mt_rand(0,count($productIdList)-1);

                        $productId = $productIdList[$productIdIndex];
                        unset($productIdList[$productIdIndex]);
                        $productIdList = array_values($productIdList);

                        $cartProduct->setProductId($productId);
                        $cartProduct->setQuantity(mt_rand(0,64));

                        $cart->addProduct($cartProduct);

                        $r = mt_rand(0,3);
                        if($r <= 1)
                        $cart->setLevel('amateur');
                        else if($r <= 2)
                        $cart->setLevel('professionnel');
                        else
                        $cart->setLevel('intermediaire');
                    }

                    for ($u=1; $u < mt_rand(0,5); $u++) {
                        $review = new Review();
                        $review->setTitle("Titre de l'avis ".$u);
                        $review->setText("Contenu de l'avis ".$u);
                        $review->setRating(mt_rand(0,5));
                        $review->setCart($cart);

                        $manager->persist($review);

                        $username = $this->getRandomWord(mt_rand(5,12));

                        $user = new User();
                        $user->setUsername($username);
                        $user->setEmail($username . '@mail.local');

                        $encoder = $this->container->get('security.password_encoder');
                        $password = $encoder->encodePassword($user, $username);
                        $user->setPassword($password);

                        $user->addReview($review);

                        $manager->persist($user);
                    }

                    $manager->persist($cart);
                    $cat->addCart($cart);

                    $productIdList = $productIdListHistory;
                }

                $manager->persist($cat);
            }
        }
        $manager->flush();
    }

    function getRandomWord($len=10) {
        $word = array_merge(range('a', 'z'), range('A', 'Z'));
        shuffle($word);
        return substr(implode($word), 0, $len);
    }
}
