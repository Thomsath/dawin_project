<?php

namespace SmartCartBundle\Service;

use GuzzleHttp\Client;

class CdiscountAPI
{
    private $apiUrl = "https://api.cdiscount.com/OpenApi/json/";
    private $apiKey = "1599d025-547a-4d2c-88d9-b4534c9fdbca";

    private $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => $this->apiUrl, 'timeout' => 12]);
    }

    public function getProduct($productId)
    {
        $res = $this->client->post('GetProduct', ['json' => [
            'ApiKey' => $this->apiKey,
            'ProductRequest' => [
                'ProductIdList' => [
                    $productId
                ],
                'Scope' => [
                    'Offers' => false,
                    'AssociatedProducts' => false,
                    'Images' => true,
                    'Ean' => false
                ]
            ]
        ]]);
        $products = json_decode((string)$res->getBody());
        if(count($products) > 0) {
            return $products->Products[0];
        }
        return null;
    }

    public function getProducts($productIdList)
    {
        $res = $this->client->post('GetProduct', ['json' => [
            'ApiKey' => $this->apiKey,
            'ProductRequest' => [
                'ProductIdList' => $productIdList,
                'Scope' => [
                    'Offers' => false,
                    'AssociatedProducts' => false,
                    'Images' => true,
                    'Ean' => false
                ]
            ]
        ]]);
        $products = json_decode((string)$res->getBody());

        if(count($products) > 0) {
            return $products;
        }
        return null;
    }

    public function pushToCart($productList)
    {
        $_productList = array();
        foreach($productList as $p) {
            $_productList[] = $p->getProductId();
        }
        $productList = $_productList;

        $checkoutUrl = null;
        $apiCount = ceil(count($productList) / 5);
        for($i=0;$i<count($apiCount);$i++)
        {
            $cartGuid = "";

            $products = $this->getProducts(array_slice($productList, $i * 5, $apiCount * 5));
            if($products->Products == null) {
                return null;
            }

            foreach($products->Products as $product) {
                if($product->BestOffer == null) {
                    return null;
                }

                $offerId = $product->BestOffer->Id;
                $sellerId = $product->BestOffer->Seller->Id;

                $res = $this->client->post('PushToCart', ['json' => [
                    'ApiKey' => $this->apiKey,
                    'PushToCartRequest' => [
                        'CartGUID' => $cartGuid,
                        'OfferId' => $offerId,
                        'ProductId' => $product->Id,
                        'Quantity' => 1,
                        'SellerId' => $sellerId,
                    ]
                ]]);

                $result = json_decode((string)$res->getBody());

                $checkoutUrl = $result->CheckoutUrl;
                $cartGuid = $result->CartGUID;
            }
        }
        return $checkoutUrl;
    }

    public function getProductMaxQuantity($productId)
    {
        $productUrl = $this->getProduct($productId)->BestOffer->ProductURL;

        $client = new Client();
        $res = $client->request('GET', $productUrl);

        $html = $res->getBody();

        preg_match_all('/<select[^>]+?ProductFormData.ProductPostedForm.QuantitySelected[^>]+?>(.*?)<\/select>/s', $html, $matches);
        $maxQuantity = $matches[1][0];
        $maxQuantity = explode("\n", $maxQuantity);
        $maxQuantity = $maxQuantity[count($maxQuantity)-2];
        $maxQuantity = intval(preg_replace('/[^0-9]+/', '', $maxQuantity), 10);

        return $maxQuantity;
    }
}
