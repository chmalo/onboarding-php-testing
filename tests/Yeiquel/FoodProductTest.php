<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Php\Yeiquel\FoodProduct;

class FoodProductTest extends TestCase
{
    public function testApplyDiscountAutomatically()
    {
        $food = new FoodProduct("Pera", 50.0, "2024-12-31");
        $food->applyDiscountFoodProduct();
        $this->assertEquals(45.0, $food->price());
    }

    public function testApplyDiscountAditional()
    {
        $food = new FoodProduct("Pera", 50.0, "2024-12-31", 10);
        $food->applyDiscountFoodProduct();
        $this->assertEquals(40.5, $food->price());
    }

    public function testSetExpirationDateValid()
    {
        $food = new FoodProduct("Milk", 30.0, "2024-12-31");
        $this->assertEquals("2024-12-31", $food->getExpirationDate());
    }

    public function testSetExpirationDateInvalidFormat()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("La fecha de expiración no es válida. Debe estar en formato YYYY-MM-DD.");
        new FoodProduct("Milk", 30.0, "31-12-2024");
    }

    public function testSetExpirationDatePast()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("La fecha de expiración debe ser una fecha futura.");
        new FoodProduct("Milk", 30.0, "2023-01-01");
    }
}
