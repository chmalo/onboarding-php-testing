<?php

namespace Php\Tests\Luis;

use Php\Tests\Luis\Product;
use SebastianBergmann\CodeCoverage\Util\Percentage;

class FoodProduct extends Product
{

    public function __construct(
        string $nombre,
        float $price
    ) {
        parent::__construct($nombre, $price);
        $this->applyDiscount(10);
    }


    public function applyDiscount($percentage): void
    {
        parent::applyDiscount($percentage);
    }
}