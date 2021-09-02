<?php

declare(strict_types=1);

class Product
{
    private float $price;
    private string $name;
    private string $code;

    public function __construct(float $price, string $name, string $code)
    {
        $this->price = $price;
        $this->name = $name;
        $this->code = $code;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCode(): string
    {
        return $this->code;
    }

}