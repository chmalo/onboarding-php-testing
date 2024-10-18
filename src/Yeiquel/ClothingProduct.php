<?php

namespace Php\Yeiquel;

use PHPUnit\Framework\MockObject\ReturnValueNotConfiguredException;

class ClothingProduct extends Product
{
    private const PRICE_MAX = 200.0;
    private const ADITIONAL_DISCOUNT_PERCENTAGE = 15;

    private const ALLOWED_SIZES = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
    private $size;

    public function __construct(string $name, float $price, string $size)
    {
        parent::__construct($name, $price);
        $this->size = $this->validateAllowedSize($size);
    }

    public function size(): string
    {
        return $this->size;
    }


    public function applyDiscountClothing(): void
    {
        $this->applyDiscount();

        $this->applyAditionalDiscount();
    }

    public function applyAditionalDiscount(): void
    {
        // Clasula de Guarda aplicada 
        if ($this->Price() <= self::PRICE_MAX) {
            return;
        }

        $aditionalDiscountPercentage = $this->calculatePercentage(self::ADITIONAL_DISCOUNT_PERCENTAGE);
        $aditionalDiscount = $this->price() * $aditionalDiscountPercentage;

        $this->price -= $aditionalDiscount;
    }

    public function convertSize(string $size): string
    {
        return strtoupper($size);
    }

    public function validateAllowedSize(string $size): string
    {
        $convertSize = $this->convertSize($size);

        if (!in_array($convertSize, self::ALLOWED_SIZES)) {
            throw new \InvalidArgumentException("La Talla no es valida.");
        }

        return $convertSize;
    }
}
