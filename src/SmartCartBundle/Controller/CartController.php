<?php

namespace SmartCartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SmartCartBundle\Entity\Cart;
use SmartCartBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    public function indexAction($cartId)
    {
        $em = $this->getDoctrine()->getManager();
        $cart = $em->getRepository(Cart::class)->findOneById($cartId);

        if(!$cart) {
            throw $this->createNotFoundException(
                'No cart found for id ' . $cartId
            );
        }

        $service = $this->get('api_service');

        $productIdList = [];
        foreach ($cart->getProducts() as $p) {
            $productIdList[] = $p->getProductId();
        }
        $products = $service->getProducts($productIdList);

        return $this->render('SmartCartBundle:Default:cart.html.twig', [
            'cart' => $cart,
            'products' => $products
        ]);
    }

    public function orderAction(Request $request, $cartId)
    {
        $em = $this->getDoctrine()->getManager();
        $cart = $em->getRepository(Cart::class)->findOneById($cartId);

        if(!$cart) {
            throw $this->createNotFoundException(
                'No cart found for id ' . $cartId
            );
        }

        $service = $this->get('api_service');
        $apiCartId = "";
        $redirectUrl = "";

        $failUrl = $this->generateUrl('smart_cart_product', array('cartId' => $cartId));

        $apiResult = $service->pushToCart($cart->getProducts());
        $redirectUrl = $apiResult != null ? $apiResult : $failUrl;

        return $this->redirect($redirectUrl);
    }

    public function categoryAction($categoryId)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository(Category::class)->findOneById($categoryId);

        if(!$category) {
            throw $this->createNotFoundException(
                'No category found for id ' . $categoryId
            );
        }

        return $this->render('SmartCartBundle:Default:category.html.twig', [
            'category' => $category
        ]);
    }
}
