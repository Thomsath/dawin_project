<?php

namespace SmartCartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SmartCartBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Request;

class LayoutController extends Controller
{
    public function headerAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(Category::class)->findAllParentsCategory();

        return $this->render('SmartCartBundle:Layout:header.html.twig', [
            'categories' => $categories
        ]);
    }
}
