<?php

namespace Php\Tests;

use PHPUnit\Framework\TestCase;
use Php\Tests\Luis\Product;
use Php\Tests\Luis\ElectronicProduct;

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
}
