<?php

namespace Php\Tests;

use PHPUnit\Framework\TestCase;
use Php\Tests\Luis\ClothesProduct;

class ClothesProductTest extends TestCase
{

    public function testApplyDiscountClothes(): void
    {
        $product = new ClothesProduct("Camisa",  250);
        $product->applyDiscount(10);
        $this->assertEquals(191.25, $product->finalPrice());
    }

    public function testApplyDiscountClothess(): void
    {
        $product = new ClothesProduct("Camisa",  250);
        $product->applyDiscount(0);
        $this->assertEquals(212.5, $product->finalPrice());
    }



}