<?php

namespace SmartCartBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="SmartCartBundle\Repository\UserRepository")
 * @UniqueEntity("username")
 * @UniqueEntity("email")
 */
class User extends BaseUser
{
    /**
    * @ORM\OneToMany(targetEntity="SmartCartBundle\Entity\Review", mappedBy="user")
    */
    private $reviews;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
    * Constructor
    */
    public function __construct()
    {
        parent::__construct();

        $this->reviews = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set login
     *
     * @param string $login
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
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
    * Get is admin
    *
    * @return boolean
    */
    public function getAdmin()
    {
        return $this->hasRole('ROLE_ADMIN');
    }

    /**
    * Set admin
    *
    * @param boolean
    * @return User
    */
    public function setAdmin($admin)
    {
        if($admin) {
            $this->addRole('ROLE_ADMIN');
        } else {
            $this->removeRole('ROLE_ADMIN');
        }
        return $this;
    }
}
