<?php


namespace Php\Yeiquel;

class ElectronicProduct extends Product {
    private float $minimumPrice;

    public function __construct(string $name, float $price, float $minimumPrice = 100.0) {
        parent::__construct($name, $price);
        $this->minimumPrice = $minimumPrice;
    }

    public function setDiscountPercentage(float $percentage): void {
        $percentage = min($percentage, 20.0);
        parent::setDiscountPercentage($percentage);
    }

    public function applyDiscount(): void {
        parent::applyDiscount();
        if ($this->price < $this->minimumPrice) {
            $this->price = $this->minimumPrice; 
        }
    }
}
