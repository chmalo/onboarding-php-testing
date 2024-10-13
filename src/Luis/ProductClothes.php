<?php

namespace Php\Tests\Luis;

use Php\Tests\Luis\Product;

class ProductClothes extends Product
{


    public function applyDiscount($percentage): void
    {

        if ($this->price > 200) {
            $additionalDiscount = $this->price * 0.15;
            $this->price -= $additionalDiscount;
        }

        parent::applyDiscount($percentage);
    }

}
