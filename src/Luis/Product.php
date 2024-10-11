<?php

namespace Php\Tests\Luis;

class Product
{
    private $name;
    private $price;

    public function __construct(
        string $name,
        float $price
    ) {
        $this->name = $name;
        $this->price = $price;
    }

    public function applyDiscount($percentage): void
    {
        if ($percentage < 0 || $percentage > 100) {

            throw new \InvalidArgumentException("El porcentaje no puede ser en negativo o estás colocando un porcentaje mayor a 100");
        }

        $descount = $this->price * ($percentage / 100);

        $this->price -= $descount;
    }

    public function finalPrice(): float
    {
        return $this->price;
    }

    public function showInfo(): string
    {
        return "El producto {$this->name} tiene un costo de {$this->price}";
    }
}