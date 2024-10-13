<?php

namespace Php\Tests;

use PHPUnit\Framework\TestCase;
use Php\Tests\Luis\Product;
use Php\Tests\Luis\ElectronicProduct;
use Php\Tests\Luis\FoodProduct;

class ProductTest extends TestCase
{
    public function testItShouldShowInformation(): void
    {
        $product = new Product("Laptop", 250);
        $showInfo = $product->showInfo();

        $this->assertEquals("El producto Laptop tiene un costo de 250", $showInfo);
    }


    public function testApplyDiscountElectronic()
    {
        $product = new ElectronicProduct("Laptop", 200);
        $product->applyDiscountElectronic(21);
        $this->assertEquals(160, $product->finalPrice());
    }

    public function testPriceDiscountElectronic()
    {
        $product = new ElectronicProduct("Laptop", 100);
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("El precio de los electrónicos no puede ser menor a $100 después del descuento.");
        $product->applyDiscountElectronic(21);
    }

    public function testApplyDiscountFood()
    {
        $product = new FoodProduct("Laptop", 100);
        $this->assertEquals(90, $product->finalPrice());
    }

    public function testApplyDiscountAdditionalFood()
    {
        $product = new FoodProduct("Laptop", 100);
        $product->applyAdditionalDiscount(10);
        $this->assertEquals(81, $product->finalPrice());
    }
}
