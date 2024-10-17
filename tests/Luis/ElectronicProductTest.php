<?php

namespace Php\Tests;

use InvalidArgumentException;
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

    public function testValidateApplyDiscountLessThan100(): void
    {
        $product = new ElectronicProduct("Laptop", 100, discountPercentage: 10);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("El precio de los electrónicos no puede ser menor a $100 después del descuento.");

        $product->applyDiscountElectronic();
    }

    public function testValidateApplyDiscount(): void
    {
        $product = new ElectronicProduct("Laptop Ryzen 20", 2000, discountPercentage: 20);
        $product->applyDiscountElectronic();
        $this->assertEquals(1600, $product->priceWithDiscount());
    }

    public function testInvalidNegativeWarranty(): void
    {
        $product = new ElectronicProduct("Laptop Ryzen 20", 2000, -1);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("El valor de la garantía debe ser mayor a 0.");

        $product->validateNegativeWarranty();
    }

    public function testValidateWarrantyRange()
    {
        $product = new ElectronicProduct("Laptop Ryzen 20", 2000, 40);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("El valor de la garantía debe ser menor a 36 meses.");

        $product->validateWarrantyRange();
    }

    public function testApplyDiscountWarranty()
    {
        $product = new ElectronicProduct("Laptop Ryzen 20", 2000, 25, 10);
        $product->applyDiscountWarranty();

        $this->assertEquals(1620, $product->priceWithDiscount());
    }

    public function testValidateWarrantyExist(): void
    {
        $product = new ElectronicProduct("Laptop", 200, 12);
        $this->assertEquals(12, $product->warranty());

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
