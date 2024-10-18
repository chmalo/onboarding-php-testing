<?php

namespace Php\Yeiquel;

class FoodProduct extends Product
{
    public function __construct(string $name, float $price)
    {
        parent::__construct($name, $price);
        $this->applyDiscount();
    }

    public function setDiscountPercentage(float $percentage): void {}

    public function applyDiscount(): void
    {
        $this->discountPercentage = 10.0;
        parent::applyDiscount();
    }
}
