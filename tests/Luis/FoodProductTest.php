<?php

namespace Php\Tests;

use PHPUnit\Framework\TestCase;
use Php\Tests\Luis\FoodProduct;

class FoodProductTest extends TestCase
{

    public function testApplyDiscountFood(): void
    {
        $product = new FoodProduct("Arroz", 100);
        $this->assertEquals(90, $product->priceWithDiscount());
    }

    public function testApplyDiscountAdditionalFood(): void
    {
        $product = new FoodProduct("Arroz", 100);
        $product->applyDiscount(10);
        $this->assertEquals(81, $product->priceWithDiscount());
    }
}
