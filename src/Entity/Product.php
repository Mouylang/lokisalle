<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $checkinAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $checkoutAt;

    /**
     * @ORM\ManyToOne(targetEntity=Room::class, inversedBy="products")
     */
    private $room;   

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=Discount::class, inversedBy="products")
     */
    private $discount;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive
     */
    private $price;

    /**
     * @ORM\OneToOne(targetEntity=OrderItem::class, mappedBy="product", cascade={"persist", "remove"})
     */
    private $orderItem;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCheckinAt(): ?\DateTimeInterface
    {
        return $this->checkinAt;
    }

    public function setCheckinAt(\DateTimeInterface $checkinAt): self
    {
        $this->checkinAt = $checkinAt;

        return $this;
    }

    public function getCheckoutAt(): ?\DateTimeInterface
    {
        return $this->checkoutAt;
    }

    public function setCheckoutAt(\DateTimeInterface $checkoutAt): self
    {
        $this->checkoutAt = $checkoutAt;

        return $this;
    }

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(?Room $room): self
    {
        $this->room = $room;

        return $this;
    }
    

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDiscount(): ?Discount
    {
        return $this->discount;
    }

    public function setDiscount(?Discount $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getOrderItem(): ?OrderItem
    {
        return $this->orderItem;
    }

    public function setOrderItem(OrderItem $orderItem): self
    {
        // set the owning side of the relation if necessary
        if ($orderItem->getProduct() !== $this) {
            $orderItem->setProduct($this);
        }

        $this->orderItem = $orderItem;

        return $this;
    }


    //-------
    private $useDiscount=false;

    public function sumbitDiscountCode(string $code): bool{
        if(isset($this->discount) && $this->discount->getDiscountCode() == $code){
             $this->useDiscount = true;
             return true;
        }else{
            return false;
        }
    }

    public function getUsedDiscountCode():string{
        if(!$this->useDiscount){
            return "";
        }else{
            return $this->discount->getDisplayName();
        }
    }

    public function getFinalPrice() :int {

        if(!isset($this->price)){
            return 0;
        }

        if ($this->useDiscount){
            return $this->price * (100-$this->discount->getReduction())/100;
        }else{
            return $this->price;
        }
    }


}
