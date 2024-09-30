<?php

use PHPUnit\Framework\TestCase;
use Prince\Phpexeption\Product;

class ProductTest extends TestCase
{
    public function testReduceStock(): void
    {
        $product = new Product(name: "Phone", price: 100, stock: 10);
        $product->reduceStock(quantity: 2);
        $this->assertEquals(8, $product->getStock());
    }
}
