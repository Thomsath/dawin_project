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
        $this->client = new Client(['base_uri' => $this->apiUrl, 'timeout' => 5]);
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
}
