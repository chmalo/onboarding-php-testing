<?php

namespace Php\Tests;

use PHPUnit\Framework\TestCase;
use Php\Tests\Luis\ClothesProduct;

class ClothesProductTest extends TestCase
{

    public function testValidateUppercase(): void
    {
        $product = new ClothesProduct("Camisa",  300, "s", 10);
        $this->assertEquals("Camisa", $product->name());
        $this->assertEquals(300, $product->price());
        $this->assertEquals("S", $product->sizes());
    }

    public function testInvalidSizes(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("La Talla no existe.");

        $product = new ClothesProduct("Camisa",  300, "p", 10);
    }

    public function testApplyDiscountProduct(): void
    {
        $product = new ClothesProduct("Camisa",  100, "S", 10);
        $product->applyDiscountClothes();
        $this->assertEquals(90, $product->priceWithDiscount());
    }

    public function testApplyDiscountProductWithDiscountAdditional(): void
    {
        $product = new ClothesProduct("Camisa Gucci",  500, "S", 10);
        $product->applyDiscountClothes();
        $this->assertEquals(382.5, $product->priceWithDiscount());
    }



    // public function testApplyDiscountClothess(): void
    // {
    //     $product = new ClothesProduct("Camisa",  250);
    //     $product->applyDiscount(0);
    //     $this->assertEquals(212.5, $product->priceWithDiscount());
    // }
}
