<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 */
class Product {
	/**
	 * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
     * @ORM\Column(type="string", length=200)
     */
	private $name;
	
	/**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
	private $price;
	
	/**
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
	private $category;
	
	/**
     * @ORM\ManyToOne(targetEntity="Material")
     * @ORM\JoinColumn(name="material_id", referencedColumnName="id")
     */
	private $material;
	
	/**
     * @ORM\Column(type="integer")
     */
	private $quantity;
	
	
    /**
     * Get id
     *
     * @return integer
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
     * @return Product
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
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Product
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set material
     *
     * @param \AppBundle\Entity\Material $material
     *
     * @return Product
     */
    public function setMaterial(\AppBundle\Entity\Material $material = null)
    {
        $this->material = $material;

        return $this;
    }

    /**
     * Get material
     *
     * @return \AppBundle\Entity\Material
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Product
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
