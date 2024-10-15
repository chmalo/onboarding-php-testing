<?php

namespace Php\Tests;

use Php\Tests\Luis\ProductClothes;
use PHPUnit\Framework\TestCase;
use Php\Tests\Luis\Product;
use Php\Tests\Luis\ElectronicProduct;
use Php\Tests\Luis\FoodProduct;

class ProductTest extends TestCase
{

    public function testValidatePrice(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("El precio debe ser mayor a 0.");
        $product = new Product("Laptop", 0);
        
    }


    public function testItShouldShowInformation(): void
    {
        $product = new Product("Laptop", 250);
        $showInfo = $product->showInfo();
        $this->assertEquals("El producto Laptop tiene un costo de 250", $showInfo);
    }


    public function testApplyDiscountElectronic(): void
    {
        $product = new ElectronicProduct("Laptop", 200);
        $product->applyDiscountElectronic(21);
        $this->assertEquals(160, $product->finalPrice());
    }

    public function testPriceDiscountElectronic()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("El precio de los electrónicos no puede ser menor a $100 después del descuento.");
        $product = new ElectronicProduct("Laptop", 100);
        $product->applyDiscountElectronic(21);
    }

    public function testApplyDiscountFood(): void
    {
        $product = new FoodProduct("Arroz", 100);
        $this->assertEquals(90, $product->finalPrice());
    }

    public function testApplyDiscountAdditionalFood(): void
    {
        $product = new FoodProduct("Arroz", 100);
        $product->applyDiscount(10);
        $this->assertEquals(81, $product->finalPrice());
    }


    public function testApplyDiscountClothes(): void
    {
        $product = new ProductClothes("Camisa",  250);
        $product->applyDiscount(10);
        $this->assertEquals(191.25, $product->finalPrice());
    }

    public function testApplyDiscountClothess(): void
    {
        $product = new ProductClothes("Camisa",  250);
        $product->applyDiscount(0);
        $this->assertEquals(212.5, $product->finalPrice());
    }
}
