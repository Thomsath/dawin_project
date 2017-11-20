<?php

namespace SmartCartBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use SmartCartBundle\Entity\Cart;
use SmartCartBundle\Entity\CartProduct;
use SmartCartBundle\Form\Type\CartType;

class CartController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $carts = $em->getRepository(Cart::class)->findAll();

        return $this->render('SmartCartBundle:Admin\Cart:index.html.twig', [
            'carts' => $carts
        ]);
    }

    public function createAction(Request $request)
    {
        $cart = new Cart();

        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(CartType::class, $cart, array(
            'entity_manager' => $em
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($cart);
            $em->flush();
        }

        return $this->render('SmartCartBundle:Admin\Cart:create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function editAction(Request $request, $cartId)
    {
        $em = $this->getDoctrine()->getManager();
        $cart = $em->getRepository(Cart::class)->findOneById($cartId);

        if (!$cart) {
            throw $this->createNotFoundException(
                'No cart found for id '.$cartId
            );
        }

        $form = $this->createForm(CartType::class, $cart, array(
            'entity_manager' => $em
        ));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($cart);
            $em->flush();
        }

        return $this->render('SmartCartBundle:Admin\Cart:edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function deleteAction(Request $request, $cartId)
    {
        $em = $this->getDoctrine()->getManager();
        $cart = $em->getRepository(Cart::class)->findOneById($cartId);

        if(!$cart) {
            throw $this->createNotFoundException(
                'No cart found for id ' . $cartId
            );
        }

        $em->remove($cart);
        $em->flush();

        return $this->redirectToRoute('smart_cart_admin_cart_list');
    }
}
