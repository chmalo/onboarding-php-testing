<?php

namespace Php\Tests\Yeiquel;
use PHPUnit\Framework\TestCase;
use Php\Yeiquel\Product;


class ProductTest extends TestCase
{
    public function testItShouldShowInformation()
    {
        $product = new Product("Laptop", 250);
        $showInformation = $product->showInformation();

        $this->assertEquals("Product: Laptop , Final Price: $ 250", $showInformation);

    }

}