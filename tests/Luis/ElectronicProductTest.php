<?php

namespace Php\Tests;

use PHPUnit\Framework\TestCase;
use Php\Tests\Luis\ElectronicProduct;

class ElectronicProductTest extends TestCase
{

    public function testValidateProductExist(): void
    {
        $product = new ElectronicProduct("Laptop", 200);
        $this->assertEquals("Laptop", $product->name());
        $this->assertEquals(200, $product->price());
        $this->assertEquals(0, $product->warranty());
        $this->assertEquals(0, $product->discountPercentage());
    }

    public function testValidateProductDiscount(): void
    {
        $product = new ElectronicProduct("Cell Alcatel", 500, discountPercentage: 50);
        $this->assertEquals(50, $product->discountPercentage());
    }

    public function testApplyDiscountToProductCorrectly(): void
    {
        $product = new ElectronicProduct("Laptop", 1000, discountPercentage: 20);
        $product->applyDiscountElectronic();
        $this->assertEquals(800, $product->priceWithDiscount());
    }

    public function testApplyDiscountToProductIncorrectly(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("El descuento no puede ser mayor al 20%.");

        $product = new ElectronicProduct("Laptop", 1000, discountPercentage: 50);
        $product->applyDiscountElectronic();
    }

    public function testValidatePriceLessThan100(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("El precio de los electrónicos no puede ser menor a $100.");
        $product = new ElectronicProduct("Laptop", 90);

    }

    public function testValidatePriceGreaterThan100(): void
    {
        $product = new ElectronicProduct("Laptop", 100);
        $this->assertEquals(100, $product->price());
    }






    // public function testApplyDiscountMinorElectronic(): void
    // {
    //     $product = new ElectronicProduct("Laptop", 200);
    //     $product->applyDiscountElectronic(10);
    //     $this->assertEquals(180, $product->finalPrice());
    // }

    // public function testPriceDiscountElectronic(): void
    // {
    //     $this->expectException(\InvalidArgumentException::class);
    //     $this->expectExceptionMessage("El precio de los electrónicos no puede ser menor a $100 después del descuento.");

    //     $product = new ElectronicProduct("Laptop", 100);
    //     $product->applyDiscountElectronic(20);
    // }

    // public function testApplyDiscountElectronicBoundary(): void
    // {
    //     $product = new ElectronicProduct("Smartphone", 125);
    //     $product->applyDiscountElectronic(20);
    //     $this->assertEquals(100, $product->finalPrice());
    // }
}
