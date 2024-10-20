<?php

namespace Php\Tests;

use PHPUnit\Framework\TestCase;
use Php\Tests\Luis\FoodProduct;

class FoodProductTest extends TestCase
{

    public function testInformationFood(): void
    {
        $product = new FoodProduct("Arroz", 100, 20);
        $this->assertEquals("Arroz", $product->name());
        $this->assertEquals(100, $product->price());
        $this->assertEquals(20, $product->discountPercentage());
    }

    public function testApplyDiscountFood(): void
    {
        $product = new FoodProduct("Arroz", 100);
        $product->applyDiscountFood();
        $this->assertEquals(90, $product->priceWithDiscount());
    }

    public function testApplyDiscountAdditionalFood(): void
    {
        $product = new FoodProduct("Arroz", 100, 20);
        $product->applyDiscountFood();
        $this->assertEquals(72, $product->priceWithDiscount());
    }
}
