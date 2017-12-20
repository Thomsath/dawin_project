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
        $categoryCarts = $em->getRepository(Cart::class)->findOthers(4);

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
        dump($products);
        return $this->render('SmartCartBundle:Default:cart.html.twig', [
            'cart' => $cart,
            'products' => $products,
            'categoryCarts' => $categoryCarts
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

        $service = $this->get('api_service');
        foreach($category->getCarts() as $cart) {
            $price = -1;
            foreach($cart->getProducts() as $product) {
                $p = $service->getProduct($product->getProductId());
                if($p->BestOffer != null) {
                    $price += $p->BestOffer->SalePrice;
                }
            }
            $cart->setPrice($price);
            $price = -1;
        }

        return $this->render('SmartCartBundle:Default:category.html.twig', [
            'category' => $category
        ]);
    }
}
