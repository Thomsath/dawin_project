<?php

namespace smartcart\smartcartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="smartcart\smartcartBundle\Repository\CommandeRepository")
 */
class Commande
{
    
        /**
   * @ORM\ManyToMany(targetEntity="smartcart\smartcartBundle\Entity\Panier")
   */
  private $paniers;
    
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;


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
     * Set prix
     *
     * @param float $prix
     *
     * @return Commande
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->paniers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add panier
     *
     * @param \smartcart\smartcartBundle\Entity\Panier $panier
     *
     * @return Commande
     */
    public function addPanier(\smartcart\smartcartBundle\Entity\Panier $panier)
    {
        $this->paniers[] = $panier;

        return $this;
    }

    /**
     * Remove panier
     *
     * @param \smartcart\smartcartBundle\Entity\Panier $panier
     */
    public function removePanier(\smartcart\smartcartBundle\Entity\Panier $panier)
    {
        $this->paniers->removeElement($panier);
    }

    /**
     * Get paniers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPaniers()
    {
        return $this->paniers;
    }
}
