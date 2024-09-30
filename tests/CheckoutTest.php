<?php

use PHPUnit\Framework\TestCase;
use Prince\Phpexeption\Checkout;
use Prince\Phpexeption\Cart;
use Prince\Phpexeption\Product;

class CheckoutTest extends TestCase
{
    public function testProcessPayment(): void
    {
        $product = new Product(name: "Phone", price: 100, stock: 10);
        $cart = new Cart();
        $cart->addItem(product: $product, quantity: 2);

        $checkout = new Checkout(cart: $cart,userBalance: 0);
        $checkout->setPaymentMethod(method: "credit card");
        
        $this->expectNotToPerformAssertions();
        $checkout->finalizeOrder();
    }
}
