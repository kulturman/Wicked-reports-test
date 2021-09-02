<?php
declare(strict_types=1);

class BasketItem
{
    private Product $product;
    private int $quantity = 0;
    private float $totalCost = 0;

    public function __construct(Product $product, int $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
        $this->totalCost = $product->getPrice();
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function add() {
        $this->totalCost += $this->product->getPrice();
        $this->quantity++;
    }

    public function doReduction(float $reduction) {
        $this->totalCost -= $reduction;
    }

    public function getTotalCost(): float
    {
        return $this->totalCost;
    }

}