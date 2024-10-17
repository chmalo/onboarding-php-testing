<?php

use Php\Yeiquel\ElectronicProduct;
use PHPUnit\Framework\TestCase;

class ElectronicProductTest extends TestCase
{
    public function testElectronicProduct()
    {
        $product = new ElectronicProduct('laptop', 250);
        $this->assertEquals('laptop', $product->name());
        $this->assertEquals(250, $product->price());
        $product->setDiscountPercentage(25);
        $product->applyDiscount();
        $this->assertEquals(225, $product->price());

    }
}
