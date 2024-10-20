<?php

namespace Php\Tests\Luis;

use Php\Tests\Luis\Product;

class FoodProduct extends Product
{

    private $discountPercentage;
    private const FIXED_DISCOUNT = 10;


    public function __construct(
        string $nombre,
        float $price,
        ?float $discountPercentage = 0
    ) {
        parent::__construct($nombre, $price);
        $this->discountPercentage = $discountPercentage;
    }

    public function discountPercentage(): ?float
    {
        return $this->discountPercentage;
    }

    public function applyDiscountFood(): void
    {
        $this->applyDiscount(self::FIXED_DISCOUNT);

        $this->applyDiscountAdditional($this->discountPercentage);
    }

    public function applyDiscountAdditional(?float $discountPercentage): void
    {
        if ($discountPercentage <= 0) {
            return;
        }

        $this->applyDiscount($this->discountPercentage);
    }
}
