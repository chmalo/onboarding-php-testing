<?php

namespace Php\Tests\Luis;

use Php\Tests\Luis\Product;

class ElectronicProduct extends Product
{

    public function applyDiscountElectronic($percentage): void
    {
        $percentage = min($percentage, 20);

        parent::applyDiscount($percentage);

        if ($this->finalPrice() < 100) {
            throw new \InvalidArgumentException("El precio de los electrónicos no puede ser menor a $100 después del descuento.");
        }
    }
}
