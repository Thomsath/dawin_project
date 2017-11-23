<?php

namespace SmartCartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SmartCartBundle\Entity\Category;
use SmartCartBundle\Form\Type\SearchType;
use Symfony\Component\HttpFoundation\Request;

class LayoutController extends Controller
{
    public function headerAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(Category::class)->findAll();

        $form = $this->createForm(SearchType::class);

        return $this->render('SmartCartBundle:Layout:header.html.twig', [
            'categories' => $categories,
            'searchForm' => $form->createView()
        ]);
    }
}
