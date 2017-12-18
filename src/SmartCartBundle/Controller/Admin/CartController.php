<?php

namespace SmartCartBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormError;
use SmartCartBundle\Entity\Cart;
use SmartCartBundle\Entity\CartProduct;
use SmartCartBundle\Entity\Category;
use SmartCartBundle\Form\Type\CartType;

class CartController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $carts = $em->getRepository(Cart::class)->findAll();
        $categories = $em->getRepository(Category::class)->findAll();

        return $this->render('SmartCartBundle:Admin\Cart:index.html.twig', [
            'carts' => $carts,
            'categories' => $categories
        ]);
    }

    public function createAction(Request $request)
    {
        $service = $this->get('api_service');
        $cart = new Cart();

        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(CartType::class, $cart, array(
            'entity_manager' => $em
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            foreach ($form->get('products') as $product) {
                if(!$service->getProduct($product->getData()->getProductId())) {
                    $product->addError(new FormError('Le produit avec l\'ID ' . $product->getData()->getProductId() . ' n\'existe pas !'));
                }
            }

            foreach ($cart->getProducts() as $product) {
                $product->setCart($cart);
            }

            if($form->isValid()) {
                $em->persist($cart);
                $em->flush();
            }
        }

        return $this->render('SmartCartBundle:Admin\Cart:create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function editAction(Request $request, $cartId)
    {
        $service = $this->get('api_service');
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

        if ($form->isSubmitted()) {
            foreach ($form->get('products') as $product) {
                if(!$service->getProduct($product->getData()->getProductId())) {
                    $product->addError(new FormError('Le produit avec l\'ID ' . $product->getData()->getProductId() . ' n\'existe pas !'));
                }
            }

            if($form->isValid()) {
                $em->persist($cart);
                $em->flush();
            }
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
