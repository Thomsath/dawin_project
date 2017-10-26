<?php

namespace SmartCartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CartProduct
 *
 * @ORM\Table(name="cart_product")
 * @ORM\Entity(repositoryClass="SmartCartBundle\Repository\CartProductRepository")
 */
class CartProduct
{
    /**
    * @ORM\Id
    * @ORM\Column(name="cart_id", type="integer")
    * @ORM\OneToMany(targetEntity="SmartCartBundle\Entity\Cart", mappedBy="cart_product")
    */
    private $cart;

    /**
    * @ORM\Id
    * @ORM\Column(name="product_id", type="integer")
    * @ORM\OneToMany(targetEntity="SmartCartBundle\Entity\Product", mappedBy="cart_product")
    */
    private $product;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

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
