<?php

use PHPUnit\Framework\TestCase;
use Php\Yeiquel\ClothingProduct;

class ClothingProductTest extends TestCase
{
    public function testClothingProduct()
    {
        $clothing = new ClothingProduct('Camisa', 250, 'L');
        $this->assertEquals('Camisa', $clothing->name());
        $this->assertEquals(250, $clothing->price());
        $this->assertEquals('L', $clothing->size());
    }

    public function testDiscountClothigProduct()
    {
        $clothing = new ClothingProduct('Camisa', 150, 'L');
        $clothing->setDiscountPercentage(20);
        $clothing->applyDiscountClothing();
        $this->assertEquals(120, $clothing->price());
    }

    public function testDiscountClothigProductWithAditionalDiscount()
    {
        $clothing = new ClothingProduct('Camisa', 350, 'L');
        $clothing->setDiscountPercentage(20);
        $clothing->applyDiscountClothing();
        $this->assertEquals(238, $clothing->price());
    }

    public function testSizeInvalidate()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("La Talla no es valida.");

        new ClothingProduct("camisa", 350, "p");
    }
}
