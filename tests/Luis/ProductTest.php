<?php

namespace Php\Tests;

use PHPUnit\Framework\TestCase;
use Php\Tests\Luis\Product;
 
 
class ProductTest extends TestCase
{
    public function testItShouldShowInformation()
    {
        $product = new Product("Laptop", 250);
        $showInfo = $product->showInfo();
 
        $this->assertEquals("El producto Laptop tiene un costo de 250", $showInfo);
 
    }
 
}