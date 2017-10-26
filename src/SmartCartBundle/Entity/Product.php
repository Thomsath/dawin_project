<?php

namespace SmartCartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="cart_product")
 * @ORM\Entity(repositoryClass="SmartCartBundle\Repository\ProductRepository")
 */
class Product
{
    /**
    * @ORM\Id
    * @ORM\ManyToOne(targetEntity="SmartCartBundle\Entity\Cart")
    */
    private $cart;

    /**
     * @var int
     *
     * @ORM\Column(name="productId", type="string")
     * @ORM\Id
     */
    private $productId;

    /**
     * Get product id
     *
     * @return string
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set product id
     *
     * @param string $productId
     *
     * @return Product
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
        return $this;
    }
}
