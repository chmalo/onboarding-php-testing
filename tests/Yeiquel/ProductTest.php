<?php

use PHPUnit\Framework\TestCase;
use Php\Yeiquel\ElectronicProduct;
use Php\Yeiquel\FoodProduct;
use Php\Yeiquel\ClothingProduct;

class ProductTest extends TestCase {
    public function testElectronicProduct(): void {
        $electronic = new ElectronicProduct("Television", 150.0);
        $electronic->setDiscountPercentage(25.0); // Maximo descuento de 20%
        $electronic->applyDiscount();
        $this->assertEquals(120.0, $electronic->Price());
    }

    public function testFoodProduct(): void {
        $food = new FoodProduct("Bread", 50.0);
        $this->assertEquals(45.0, $food->Price());
    }

    public function testClothingProduct(): void {
        $clothing = new ClothingProduct("Jacket", 250.0);
        $clothing->setDiscountPercentage(10.0);
        $clothing->applyDiscount();
        $this->assertEquals(191.25, $clothing->Price());
    }
}
