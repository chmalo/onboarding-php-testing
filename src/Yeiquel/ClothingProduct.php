<?php

namespace Php\Yeiquel;

class ClothingProduct extends Product {
    public function applyDiscount(): void {
        parent::applyDiscount();
        if ($this->Price() > 200.0) {
            $additionalDiscount = $this->Price() * 0.15; 
            $this->price -= $additionalDiscount;
        }
    }
}
