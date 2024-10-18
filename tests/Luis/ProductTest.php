<?php

namespace Php\Tests;

use PHPUnit\Framework\TestCase;
use Php\Tests\Luis\Product;

class ProductTest extends TestCase
{

    public function testItShouldShowInformation(): void
    {
        $product = new Product("Laptop", 250);
        $showInfo = $product->showInfo();
        $this->assertEquals("El producto Laptop tiene un costo de 250", $showInfo);
    }

    public function testDiscountCorrect(): void
    {
        $product = new Product("Laptop Lenovo I3", 1000);
        $product->applyDiscount(20);
        $this->assertEquals(800, $product->finalprice());
    }

    public function testValidatePrice(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("El precio debe ser mayor a 0.");
        $product = new Product("Laptop", -100);
    }

    public function testNegativeDiscount(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("El porcentaje no puede ser en negativo o estás colocando un porcentaje mayor a 100.");
        $product = new Product("Laptop", 100);
        $product->applyDiscount(-1);
    }

    public function testDiscountGreaterThan100(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("El porcentaje no puede ser en negativo o estás colocando un porcentaje mayor a 100.");
        $product = new Product("Laptop", 100);
        $product->applyDiscount(120);
    }
}
