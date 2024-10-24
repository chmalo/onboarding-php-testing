<?php

namespace Php\Tests;

use PHPUnit\Framework\TestCase;
use Php\Tests\Luis\FoodProduct;
use InvalidArgumentException;

class FoodProductTest extends TestCase
{

    public function testInformationFood(): void
    {
        $product = new FoodProduct("Arroz", 100, 20, expirationDate:"2024-11-20");
        $this->assertEquals("Arroz", $product->name());
        $this->assertEquals(100, $product->price());
        $this->assertEquals(20, $product->discountPercentage());
    }

    public function testApplyDiscountFood(): void
    {
        $product = new FoodProduct("Arroz", 100, expirationDate:"2024-11-20");
        $product->applyDiscountFood();
        $this->assertEquals(90, $product->priceWithDiscount());
    }

    public function testApplyDiscountAdditionalFood(): void
    {
        $product = new FoodProduct("Arroz", 100, 20, expirationDate:"2024-11-20");
        $product->applyDiscountFood();
        $this->assertEquals(72, $product->priceWithDiscount());
    }

    public function testValidExpirationDate(): void
    {
        $product = new FoodProduct("Arroz", 500, 10, expirationDate:"2024-11-20");
        $this->assertEquals("2024-11-20", $product->expirationDate());
    }

    public function testInvalidExpirationDateFormat(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("La fecha debe ser válida en formato YYYY-MM-DD.");

        $product = new FoodProduct("Arroz", 500, 10, expirationDate:"20-11-2024");
    }

    public function testExpirationDateInThePast(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("La fecha de expiración no puede ser anterior a la fecha actual.");

        $product = new FoodProduct("Arroz", 500, 10, expirationDate:"2024-10-15");
    }

    public function testEmptyExpirationDate(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("La fecha de expiración es obligatoria.");

        $product = new FoodProduct("Arroz", 500, 10, expirationDate:"");
    }
}
