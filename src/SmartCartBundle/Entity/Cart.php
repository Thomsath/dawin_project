<?php

namespace SmartCartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
* Panier
*
* @ORM\Table(name="cart")
* @ORM\Entity(repositoryClass="SmartCartBundle\Repository\CartRepository")
* @UniqueEntity("name")
*/
class Cart
{
    /**
    * @ORM\OneToMany(targetEntity="SmartCartBundle\Entity\CartProduct", mappedBy="cart", cascade={"persist", "remove"})
    */
    private $products;

    /**
    * @ORM\ManyToOne(targetEntity="SmartCartBundle\Entity\Category")
    */
    private $category;

    /**
    * @ORM\OneToMany(targetEntity="SmartCartBundle\Entity\Review", mappedBy="cart")
    */
    private $reviews;


    /**
    * @var int
    *
    * @ORM\Column(name="id", type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    private $id;

    /**
    * @var string
    *
    * @ORM\Column(name="name", type="string", length=255)
    */
    private $name;

    /**
    * @var string
    *
    * @ORM\Column(name="description", type="text")
    */
    private $description;

    /**
    * @var int
    *
    * @ORM\Column(name="quantity", type="integer")
    */
    private $quantity;

    /**
    * @var float
    *
    * @ORM\Column(name="price", type="float")
    */
    private $price;

    /**
    * @var string
    *
    * @ORM\Column(name="image", type="string", length=255)
    */
    private $image;

    /**
    * @var Cart
    *
    * @ORM\OneToOne(targetEntity="SmartCartBundle\Entity\Cart")
    */
    private $associated_cart;

    /**
    * Constructor
    */
    public function __construct()
    {
        $this->reviews = new \Doctrine\Common\Collections\ArrayCollection();
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
    * Get id
    *
    * @return int
    */
    public function getId()
    {
        return $this->id;
    }

    /**
    * Set name
    *
    * @param string $name
    *
    * @return Cart
    */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
    * Get name
    *
    * @return string
    */
    public function getName()
    {
        return $this->name;
    }

    /**
    * Set description
    *
    * @param string $description
    *
    * @return Cart
    */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
    * Get description
    *
    * @return string
    */
    public function getDescription()
    {
        return $this->description;
    }

    /**
    * Set quantity
    *
    * @param integer $quantity
    *
    * @return Cart
    */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
    * Get quantity
    *
    * @return int
    */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
    * Set price
    *
    * @param float $price
    *
    * @return Cart
    */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
    * Get price
    *
    * @return float
    */
    public function getPrice()
    {
        return $this->price;
    }

    /**
    * Set image
    *
    * @param string $image
    *
    * @return Cart
    */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
    * Get image
    *
    * @return string
    */
    public function getImage()
    {
        return $this->image;
    }

    /**
    * Set associated cart
    *
    * @param Cart $associated_cart
    *
    * @return Cart
    */
    public function setAssociatedCart($associated_cart)
    {
        $this->associated_cart = $associated_cart;
        return $this;
    }

    /**
    * Get associated cart
    *
    * @return Cart
    */
    public function getAssociatedCart()
    {
        return $this->associated_cart;
    }

    public function setCategory(Category $category)
    {
        $this->category = $category;
        return $this;
    }

    public function getCategory()
    {
        return $this->category;
    }

    /**
    * Add review
    *
    * @param \SmartCartBundle\Entity\Review $review
    *
    * @return Review
    */
    public function addReview(Review $review)
    {
        $this->reviews[] = $review;
        return $this;
    }

    /**
    * Remove review
    *
    * @param \SmartCartBundle\Entity\Review $review
    */
    public function removeReview(Review $review)
    {
        $this->reviews->removeElement($review);
    }

    /**
    * Get reviews
    *
    * @return \Doctrine\Common\Collections\Collection
    */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
    * Get products
    *
    * @return \Doctrine\Common\Collections\Collection
    */
    public function getProducts()
    {
        return $this->products;
    }

    /**
    * Set products
    *
    * @return Cart
    */
    public function setProducts($products)
    {
        $this->products = $products;
        return $this;
    }

    /**
    * Add product
    *
    * @return Cart
    */
    public function addProduct(CartProduct $product)
    {
        $this->products->add($product);
        $product->setCart($this);
        return $this;
    }
}
