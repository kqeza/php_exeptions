<?php

namespace Prince\Phpexeption;

use Prince\Phpexeption\Exceptions\OutOfStockException;

class Product
{
    protected string $name;
    protected float $price;
    protected int $stock;

    public function __construct(string $name, float $price, int $stock)
    {
        $this->name = $name;
        $this->price = $price;
        $this->stock = $stock;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStock(): int
    {
        return $this->stock;
    }
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * Уменьшает количество товара на складе.
     *
     * @param  int $quantity Количество для уменьшения.
     * @throws OutOfStockException Если недостаточно товара на складе.
     */

    public function reduceStock(int $quantity): void
    {
        if ($this->stock < $quantity) {
            throw new OutOfStockException(message: "Недостаточно товара на складе для продукта: " . $this->name);
        }
        $this->stock -= $quantity;
    }
}
