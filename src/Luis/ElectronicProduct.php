<?php

namespace Php\Tests\Luis;

use Php\Tests\Luis\Product;

class ElectronicProduct extends Product
{

    private $warranty;
    private $discountPercentage;

    public function __construct(
        string $name,
        float $price,
        ?int $warranty = 0,
        ?float $discountPercentage = 0

    ) {
        parent::__construct($name, $price);
        $this->price =  $this->validatePriceElectronic($price);
        $this->warranty = $warranty;
        $this->discountPercentage = $discountPercentage;
    }

    public function validatePriceElectronic($price)
    {
        if ($price < 100) {
            throw new \InvalidArgumentException("El precio de los electrónicos no puede ser menor a $100.");
        }

        return $price;
    }

    public function warranty(): ?int
    {
        return $this->warranty;
    }

    public function discountPercentage(): ?float
    {
        return $this->discountPercentage;
    }

    public function applyDiscountElectronic(): void
    {

        if ($this->discountPercentage > 20) {
            throw new \InvalidArgumentException("El descuento no puede ser mayor al 20%.");
        }

        parent::applyDiscount($this->discountPercentage);


        if ($this->priceWithDiscount() < 100) {
            throw new \InvalidArgumentException("El precio de los electrónicos no puede ser menor a $100 después del descuento.");
        }
    }

    public function validateNegativeWarranty()
    {
        if ($this->warranty < 0) {
    
            throw new \InvalidArgumentException("El valor de la garantía debe ser mayor a 0.");
        }

    }

    public function validateWarrantyRange(): void
    {
        if ($this->warranty > 36) {
            throw new \InvalidArgumentException("El valor de la garantía debe ser menor a 36 meses.");
        }
    }

    public function applyDiscountWarranty(): void
    {

        if ($this->warranty < 24) {
            return;
        }

        parent::applyDiscount($this->discountPercentage);
        
        $additionalDiscount = $this->price * (10 / 100);
        $this->price -= $additionalDiscount;
    }
}
