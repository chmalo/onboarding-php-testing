<?php

namespace Php\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Php\Tests\Luis\ElectronicProduct;

class ElectronicProductTest extends TestCase
{

    public function testValidateProductExist(): void
    {
        $product = new ElectronicProduct("Laptop", 200, 10, 20);
        $this->assertEquals("Laptop", $product->name());
        $this->assertEquals(200, $product->price());
        $this->assertEquals(10, $product->warranty());
        $this->assertEquals(20, $product->discountPercentage());
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
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("El valor de la garantía debe ser mayor a 0.");

        new ElectronicProduct("Laptop Ryzen 20", 2000, -1);
        
    }

    public function testValidateWarrantyRange()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("El valor de la garantía no debe ser mayor a los 36 meses.");

        new ElectronicProduct("Laptop Ryzen 20", 2000, 40);

    }

    public function testApplyDiscountWarranty(): void
    {
        $product = new ElectronicProduct("Laptop Ryzen 20", 2000, 25, 10);
        $product->applyDiscountElectronic();

        $this->assertEquals(1620, $product->priceWithDiscount());
    }

    public function testApplyDiscountWarrantyNULL(): void
    {
        $product = new ElectronicProduct("Laptop Ryzen 20", 2000, 25);
        $product->applyDiscountWarranty();

        $this->assertEquals(1800, $product->priceWithDiscount());
    }
}
