<?php

namespace App\Entity;

use App\Repository\OrderItemRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderItemRepository::class)
 */
class OrderItem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="orderItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $associatedOrder;

    /**
     * @ORM\OneToOne(targetEntity=Product::class, inversedBy="orderItem", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAssociatedOrder(): ?Order
    {
        return $this->associatedOrder;
    }

    public function setAssociatedOrder(?Order $associatedOrder): self
    {
        $this->associatedOrder = $associatedOrder;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    
}
