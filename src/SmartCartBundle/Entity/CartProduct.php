<?php

namespace SmartCartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CartProduct
 *
 * @ORM\Table(name="cart_product")
 * @ORM\Entity(repositoryClass="SmartCartBundle\Repository\CartProductRepository")
 */
class CartProduct
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
    * @ORM\ManyToOne(targetEntity="SmartCartBundle\Entity\Cart")
    * @ORM\JoinColumn(name="cart_id", referencedColumnName="id", nullable=false)
    */
    private $cart;

    /**
     * @var string
     *
     * @ORM\Column(name="productId", type="string", length=255)
     *
     * @Assert\Type(
     *     type="string",
     *     message="L'ID du produit n'est pas valide."
     * )
     */
    private $productId;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     *
     * @Assert\Type(
     *     type="integer",
     *     message="La quantité du produit n''est pas valide."
     * )
     */
    private $quantity;

    public function setProductId($productId)
    {
        $this->productId = $productId;
        return $this;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function setCart($cart)
    {
        $this->cart = $cart;
        return $this;
    }
}
