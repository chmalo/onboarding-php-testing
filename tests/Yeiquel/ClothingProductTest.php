<?php

use PHPUnit\Framework\TestCase;
use Php\Yeiquel\ClothingProduct;

class ClothingProductTest extends TestCase
{
    public function testClothingProduct()
    {
        $product = new ClothingProduct('Camisa', 250, 'L');
        $this->assertEquals('Camisa', $product->name());
        $this->assertEquals(250, $product->price());
        $this->assertEquals('L', $product->size());
    }

    public function testDiscountClothigProduct()
    {
        $product = new ClothingProduct('Camisa', 150, 'L');
        $product->setDiscountPercentage(20);
        $product->applyDiscountClothing();
        $this->assertEquals(120, $product->price());
    }

    public function testDiscountClothigProductWithAditionalDiscount()
    {
        $product = new ClothingProduct('Camisa', 350, 'L');
        $product->setDiscountPercentage(20);
        $product->applyDiscountClothing();
        $this->assertEquals(238, $product->price());
    }

    public function testSizeInvalidate()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("La Talla no es valida.");

        new ClothingProduct("camisa", 350, "p");
    }
}
