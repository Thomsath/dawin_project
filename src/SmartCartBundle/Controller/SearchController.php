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

        $form = $this->createForm(SearchType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $search = $form->get('search')->getData();
            $carts = $em->getRepository(Cart::class)->findAllContains($search);
        }

        return $this->render('SmartCartBundle:Default:search.html.twig', [
            'carts' => $carts
        ]);
    }
}
