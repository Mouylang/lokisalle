<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


class Cart
{

    private $product_ids;
    private $discountCodes;
    public function __construct()
    {
        $this->product_ids = new ArrayCollection();
        $this->discountCodes = new ArrayCollection();
    }

    //la fonction permet d'ajouter un pour chaque produit 
    public function addProduct(int $product_id)
    {
        if (!$this->product_ids->contains($product_id)) {
            $this->product_ids[] = $product_id;
        }
    }

    public function removeProduct(int $product_id)
    {
        $this->product_ids->removeElement($product_id);
    }

    public function getAllProduct()
    {
        return $this->product_ids->toArray();
    }

    public function addDiscountCode(string $discountCode){
        if (!$this->discountCodes->contains($discountCode)) {
            $this->discountCodes[] = $discountCode;
        }
    }

    public function getAllDiscountCode()
    {
        return $this->discountCodes->toArray();
    }


}
