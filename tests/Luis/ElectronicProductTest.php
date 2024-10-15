<?php

namespace Php\Tests;

use PHPUnit\Framework\TestCase;
use Php\Tests\Luis\ElectronicProduct;

class ElectronicProductTest extends TestCase
{

    public function testApplyDiscountElderlyElectronic(): void
    {
        $product = new ElectronicProduct("Laptop", 200);
        $product->applyDiscountElectronic(25);
        $this->assertEquals(160, $product->finalPrice());
    }

    public function testApplyDiscountMinorElectronic(): void
    {
        $product = new ElectronicProduct("Laptop", 200);
        $product->applyDiscountElectronic(10);
        $this->assertEquals(180, $product->finalPrice());
    }

    public function testPriceDiscountElectronic(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("El precio de los electrónicos no puede ser menor a $100 después del descuento.");

        $product = new ElectronicProduct("Laptop", 100);
        $product->applyDiscountElectronic(20);
    }

    public function testApplyDiscountElectronicBoundary(): void
    {
        $product = new ElectronicProduct("Smartphone", 125);
        $product->applyDiscountElectronic(20);
        $this->assertEquals(100, $product->finalPrice());
    }
}
