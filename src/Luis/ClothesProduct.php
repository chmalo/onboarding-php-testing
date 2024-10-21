<?php

namespace Php\Tests\Luis;

use Php\Tests\Luis\Product;

class ClothesProduct extends Product
{
    private const DISCOUNT_CLOTHES = 15;

    private const TALLAS_PERMITIDAS = ["XS", "S", "M", "L", "XL", "XXL"];

    private const MAX_DISCOUNT_PRICE = 200;

    private $discountPercentage = 0;

    private $sizes;

    public function __construct(
        string $name,
        float $price,
        string $sizes,
        ?float $discountPercentage
    ) {
        parent::__construct($name, $price);
        $this->sizes = $this->validateSizes($sizes);
        $this->discountPercentage = $discountPercentage;
    }

    public function sizes(): string
    {
        return $this->sizes;
    }

    public function discountPercentage(): ?float
    {
        return $this->discountPercentage;
    }

    public function applyDiscountClothes(): void
    {
        $this->applyDiscount($this->discountPercentage);

        $this->applyDiscountAdditional();
    }

    public function applyDiscountAdditional(): void
    {

        if ($this->price < self::MAX_DISCOUNT_PRICE) {
            return;
        }

        $calculatePercentege = $this->calculatePercentage(self::DISCOUNT_CLOTHES);
        $additionalDiscount = $this->price * $calculatePercentege;

        $this->price -= $additionalDiscount;
    }

    public function validateUppercaseConversion(string $sizes): string
    {
        return strtoupper($sizes);
    }

    public function validateSizes(string $sizes): string
    {
        $validateUppercaseConversion = $this->validateUppercaseConversion($sizes);

        if (!in_array($validateUppercaseConversion, self::TALLAS_PERMITIDAS)) {
            throw new \InvalidArgumentException("La Talla no existe.");
        }

        return $validateUppercaseConversion;
    }
}
