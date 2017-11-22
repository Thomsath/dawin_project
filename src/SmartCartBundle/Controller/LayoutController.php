<?php

namespace SmartCartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SmartCartBundle\Entity\Category;

class LayoutController extends Controller
{
    public function headerAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(Category::class)->findAll();

        return $this->render('SmartCartBundle:Layout:header.html.twig', [
            'categories' => $categories
        ]);
    }
}
