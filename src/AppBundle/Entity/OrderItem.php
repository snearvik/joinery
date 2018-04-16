<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="order_item")
 */
class OrderItem {
	/**
	 * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
     * @ORM\ManyToOne(targetEntity="Order")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     */ 
	private $order;
	
	/**
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */ 
	private $product;
		
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
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return OrderItem
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
     * Set order
     *
     * @param \AppBundle\Entity\Order $order
     *
     * @return OrderItem
     */
    public function setOrder(\AppBundle\Entity\Order $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \AppBundle\Entity\Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set product
     *
     * @param \AppBundle\Entity\Product $product
     *
     * @return OrderItem
     */
    public function setProduct(\AppBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \AppBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }
}
