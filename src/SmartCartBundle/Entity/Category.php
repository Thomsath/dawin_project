<?php

namespace SmartCartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
* Categorie
*
* @ORM\Table(name="category")
* @ORM\Entity(repositoryClass="SmartCartBundle\Repository\CategoryRepository")
* @UniqueEntity("name", message="La catégorie existe déjà.")
*/
class Category
{
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
    *
    * @Assert\Length(
    *      min = 3,
    *      max = 255,
    *      minMessage = "Le nom de la catégorie doit avoir plus de {{ limit }} caractères",
    *      maxMessage = "Le nom de la catégorie ne doit pas excéder plus de {{ limit }} caractères"
    * )
    *
    * @Assert\Type(
    *     type="alpha",
    *     message="La catégorie ne doit contenir que des lettres."
    * )
    */
    private $name;

    /**
    * @ORM\OneToMany(targetEntity="SmartCartBundle\Entity\Cart", mappedBy="category", cascade={"persist", "remove"})
    */
    private $carts;

    /**
    * Constructor
    */
    public function __construct()
    {
        $this->carts = new \Doctrine\Common\Collections\ArrayCollection();
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
    * @return Category
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
    * Add cart
    *
    * @param \SmartCartBundle\Entity\Cart $cart
    *
    * @return Category
    */
    public function addCart(Cart $cart)
    {
        $this->carts->add($cart);
        $cart->setCategory($this);
        return $this;
    }

    /**
    * Get carts
    *
    * @return array
    */
    public function getCarts()
    {
        return $this->carts;
    }

    public function __toString()
    {
        return $this->name;
    }
}
