<?php

namespace SmartCartBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use SmartCartBundle\Entity\Category;
use SmartCartBundle\Form\Type\CategoryType;

class CategoryController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(Category::class)->findAll();

        return $this->render('SmartCartBundle:Admin\Category:index.html.twig', [
            'categories' => $categories
        ]);
    }
}
