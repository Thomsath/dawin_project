<?php

namespace SmartCartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Review
 *
 * @ORM\Table(name="review")
 * @ORM\Entity(repositoryClass="SmartCartBundle\Repository\ReviewRepository")
 */
class Review
{
    /**
    * @ORM\ManyToOne(targetEntity="SmartCartBundle\Entity\User", inversedBy="reviews")
    */
    private $user;

    /**
    * @ORM\ManyToOne(targetEntity="SmartCartBundle\Entity\Cart", inversedBy="reviews")
    */
    private $cart;

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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=255)
     */
    private $text;

    /**
     * @var string
     *
     * @ORM\Column(name="rating", type="string", columnDefinition="enum('0','1','2','3','4','5')")
     *
     * @Assert\Choice(choices = {"0","1","2","3","4","5"}, message = "La note n'est pas valide.")
     */
    private $rating;


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
     * Set text
     *
     * @param string $text
     *
     * @return Review
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set rating
     *
     * @param string $rating
     *
     * @return Review
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
        return $this;
    }

    /**
     * Get rating
     *
     * @return string
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
    * Set cart
    *
    * @return Review
    */
    public function setCart(Cart $cart)
    {
        $this->cart = $cart;
        return $this;
    }

    /**
    * Get cart
    *
    * @return Cart
    */
    public function getCart()
    {
        return $this->cart;
    }

    /**
    * Set user
    *
    * @return Review
    */
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
    * Get user
    *
    * @return User
    */
    public function getUser()
    {
        return $this->user;
    }

    /**
    * Set title
    *
    * @return Review
    */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
    * Get user
    *
    * @return Review
    */
    public function getTitle()
    {
        return $this->title;
    }
}
