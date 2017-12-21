<?php

namespace SmartCartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SmartCartBundle\Entity\Cart;
use SmartCartBundle\Entity\Category;
use SmartCartBundle\Form\Type\SearchType;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $carts = array();

        if($request->get('search'))
        {
            $search = $request->get('search');
            $carts = $em->getRepository(Cart::class)->findAllContains($search);
        }

        return $this->render('SmartCartBundle:Default:search.html.twig', [
            'carts' => $carts
        ]);
    }
}
