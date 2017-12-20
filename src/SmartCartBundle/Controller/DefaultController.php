<?php

namespace SmartCartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SmartCartBundle\Entity\Cart;
use SmartCartBundle\Entity\Category;

class DefaultController extends Controller
{
    public function homeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $popularRatingCartsAmateur = $em->getRepository(Cart::class)->findAllOrderByRatingAndLevel(4, "amateur");
        $popularRatingCartsInter = $em->getRepository(Cart::class)->findAllOrderByRatingAndLevel(4, "intermediaire");
        $popularRatingCartsPro = $em->getRepository(Cart::class)->findAllOrderByRatingAndLevel(4, "professionnel");
        $randomCarts = $em->getRepository(Cart::class)->findAllRandom(4);
        $categories = $em->getRepository(Category::class)->findAll();

        return $this->render('SmartCartBundle:Default:home.html.twig', [
            'popularRatingCartsAmateur' => $popularRatingCartsAmateur,
            'popularRatingCartsInter' => $popularRatingCartsInter,
            'popularRatingCartsPro' => $popularRatingCartsPro,
            'categories' => $categories,
            'randomCarts' => $randomCarts
        ]);
    }
}
