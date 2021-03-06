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

    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($category);
            $em->flush();
        }

        return $this->render('SmartCartBundle:Admin\Category:create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function editAction(Request $request, $categoryId)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository(Category::class)->findOneById($categoryId);

        if(!$category) {
            throw $this->createNotFoundException(
                'No category found for id ' . $categoryId
            );
        }

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($category);
            $em->flush();
        }

        return $this->render('SmartCartBundle:Admin\Category:edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function deleteAction(Request $request, $categoryId)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository(Category::class)->findOneById($categoryId);

        if(!$category) {
            throw $this->createNotFoundException(
                'No category found for id ' . $categoryId
            );
        }

        $em->remove($category);
        $em->flush();

        return $this->redirectToRoute('smart_cart_admin_category_list');
    }
}
