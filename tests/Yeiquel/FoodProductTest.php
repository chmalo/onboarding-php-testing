<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Php\Yeiquel\FoodProduct;

class FoodProductTest extends TestCase
{
    public function testApplyDiscountAutomatically()
    {
        $food = new FoodProduct("Pera", 50.0, "2024-12-31");
        $this->assertEquals(45.0, $food->price());

        $food = new FoodProduct("Manzana", 20.0, "2024-12-31");
        $this->assertEquals(18.0, $food->price());
    }

    public function testSetDiscountPercentage()
    {
        $food = new FoodProduct("Leche", 30.0, "2024-12-31");
        $food->setDiscountPercentage(10.0); //Error al sumar el 10% + 10%
        $this->assertEquals(24.0, $food->price());

        $food = new FoodProduct("Jugo", 40.0, "2024-12-31");
        $food->setDiscountPercentage(20.0);
        $this->assertEquals(28.0, $food->price());
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
