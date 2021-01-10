<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


class Cart{

private $product_ids;

public function __construct()
    {
        $this->product_ids = new ArrayCollection();
    }

    public function addProduct(int $product_id)
    {
        if (!$this->product_ids->contains($product_id)) {
            $this->product_ids[] = $product_id;
        }

    }

    public function removeProduct(int $product_id)
     {
         $this->product_ids->remove($product_id);
     }

     public function getAllProduct(){
         return $this->product_ids->toArray();
     }


}
