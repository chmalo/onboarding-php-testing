<?php

namespace Php\Yeiquel;

class ElectronicProduct extends Product {
    private float $minimumPrice = 100.0;

    public function setDiscountPercentage(float $percentage): void {
        $percentage = min($percentage, 20.0); 
        parent::setDiscountPercentage($percentage);
    }

    public function applyDiscount(): void {
        parent::applyDiscount();
        if ($this->price() < $this->minimumPrice) {
            $this->price = $this->minimumPrice; 
        }
    }
}
