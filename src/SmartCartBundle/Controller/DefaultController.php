<?php

namespace SmartCartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SmartCartBundle\Entity\Cart;
use SmartCartBundle\Entity\Category;

class DefaultController extends Controller
{
    private $popularRatingCartLimit = 10;

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $popularRatingCarts = $em->getRepository(Cart::class)->findAllOrderByRating($this->popularRatingCartLimit);
        $categories = $em->getRepository(Category::class)->findAll();

        return $this->render('SmartCartBundle:Default:index.html.twig', [
            'popularRatingCarts' => $popularRatingCarts,
            'categories' => $categories
        ]);
    }

    public function legalMentionsAction()
    {
        return $this->render('SmartCartBundle:Default:mentions.html.twig');
    }
}
