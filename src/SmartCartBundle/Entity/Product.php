<?php

namespace SmartCartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="SmartCartBundle\Repository\ProductRepository")
 * @UniqueEntity(fields={"productId"})
 */
class Product
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
     * @var int
     *
     * @ORM\Column(name="productId", type="string")
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
