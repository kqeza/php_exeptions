<?php

use PHPUnit\Framework\TestCase;
use Prince\Phpexeption\Cart;
use Prince\Phpexeption\Product;
use Prince\Phpexeption\Exceptions\ItemOutOfStockException;
use Prince\Phpexeption\Exceptions\CartLimitExceededException;

class CartTest extends TestCase
{
    public function testAddItemToCart(): void
    {
        $product = new Product(name: "Phone", price: 100, stock: 10);
        $cart = new Cart();
        $cart->addItem(product: $product, quantity: 2);
        $this->assertEquals(8, $product->getStock());
    }

    public function testItemOutOfStockException(): void
    {
        $this->expectException(ItemOutOfStockException::class);
        $product = new Product(name: "Phone", price: 100, stock: 1);
        $cart = new Cart();
        $cart->addItem(product: $product, quantity: 2);
    }

    public function testCartLimitExceededException(): void
    {
        $this->expectException(CartLimitExceededException::class);
        $cart = new Cart(maxItems: 1);
        $product1 = new Product(name: "Phone", price: 100, stock: 10);
        $product2 = new Product(name: "Laptop", price: 200, stock: 5);
        $cart->addItem(product: $product1, quantity: 1);
        $cart->addItem(product: $product2, quantity: 1); // исключение
    }
}
