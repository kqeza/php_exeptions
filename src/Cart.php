<?php

namespace Prince\Phpexeption;

use Prince\Phpexeption\Exceptions\ItemOutOfStockException;
use Prince\Phpexeption\Exceptions\CartLimitExceededException;

class Cart
{
    /** @var array<int, array{product: Product, quantity: int}> */
    private array $items = [];
    private int $maxItems;

    public function __construct(int $maxItems = 20)
    {
        $this->maxItems = $maxItems;
    }
    /**
     * @throws CartLimitExceededException
     * @throws ItemOutOfStockException|Exceptions\OutOfStockException
     */
    public function addItem(Product $product, int $quantity): void
    {
        if (count(value: $this->items) >= $this->maxItems) {
            throw new CartLimitExceededException(message: "Cart limit exceeded.");
        }

        if ($product->getStock() < $quantity) {
            throw new ItemOutOfStockException(message: "Not enough stock for product: 
            " . $product->getName());
        }

        $product->reduceStock(quantity: $quantity);
        $this->items[] = ['product' => $product, 'quantity' => $quantity];
    }

    public function getTotal(): int
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item['product']->getPrice() * $item['quantity'];
        }
        return (int) $total;
    }
}
