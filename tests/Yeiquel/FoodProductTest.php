<?php

use Php\Yeiquel\FoodProduct;
use PHPUnit\Framework\TestCase;

class FoodProductTest extends TestCase
{
    public function testFoodProduct()
    {
        $product =  new FoodProduct('manzana', 20);
        //$this->assertEquals('manzana', $product->name());
       // $this->assertEquals(20, $product->price());
        $product->setDiscountPercentage(1);
        $product->applyDiscount();
        $this->assertEquals(18, $product->price());
    }
}
