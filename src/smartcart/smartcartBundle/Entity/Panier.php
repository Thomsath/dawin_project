<?php

namespace smartcart\smartcartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Panier
 *
 * @ORM\Table(name="panier")
 * @ORM\Entity(repositoryClass="smartcart\smartcartBundle\Repository\PanierRepository")
 */
class Panier
{
    /**
   * @ORM\ManyToOne(targetEntity="smartcart\smartcartBundle\Entity\Categorie")
   */
  private $categorie;
  
  
    /**
   * @ORM\ManyToMany(targetEntity="smartcart\smartcartBundle\Entity\Produit")
   */
  private $produits;
  
    
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $nbProduit;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;

    /**
     * @var int
     *
     * @ORM\Column(name="classement", type="integer")
     */
    private $classement;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;
    
    /**
     * @var int
     *
     * @ORM\Column(name="panier_associe", type="integer")
     */
    private $panierAssocie;



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
     * Set nom
     *
     * @param string $nom
     *
     * @return Panier
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Panier
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
     * Set nbProduit
     *
     * @param integer $nbProduit
     *
     * @return Panier
     */
    public function setNbProduit($nbProduit)
    {
        $this->nbProduit = $nbProduit;

        return $this;
    }

    /**
     * Get nbProduit
     *
     * @return int
     */
    public function getNbProduit()
    {
        return $this->nbProduit;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Panier
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
     * Set classement
     *
     * @param integer $classement
     *
     * @return Panier
     */
    public function setClassement($classement)
    {
        $this->classement = $classement;

        return $this;
    }

    /**
     * Get classement
     *
     * @return int
     */
    public function getClassement()
    {
        return $this->classement;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Panier
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
     * Set panierAssocie
     *
     * @param integer $panierAssocie
     *
     * @return Produit
     */
    public function setPanierAssocie($panierAssocie)
    {
        $this->panierAssocie = $panierAssocie;

        return $this;
    }

    /**
     * Get panierAssocie
     *
     * @return int
     */
    public function getPanierAssocie()
    {
        return $this->panierAssocie;
    }
    
    public function setCategorie(Categorie $categorie)
  {
    $this->categorie = $categorie;

    return $this;
  }

  public function getCategorie()
  {
    return $this->categorie;
  }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->produits = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add produit
     *
     * @param \smartcart\smartcartBundle\Entity\Produit $produit
     *
     * @return Panier
     */
    public function addProduit(\smartcart\smartcartBundle\Entity\Produit $produit)
    {
        $this->produits[] = $produit;

        return $this;
    }

    /**
     * Remove produit
     *
     * @param \smartcart\smartcartBundle\Entity\Produit $produit
     */
    public function removeProduit(\smartcart\smartcartBundle\Entity\Produit $produit)
    {
        $this->produits->removeElement($produit);
    }

    /**
     * Get produits
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProduits()
    {
        return $this->produits;
    }
}
