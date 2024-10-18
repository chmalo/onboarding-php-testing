<?php

namespace Php\Tests\Luis;

class Product
{
    protected $name;
    protected $price;

    public function __construct(
        string $name,
        float $price
    ) {
        $this->name = $name;
        $this->price = $this->validatePrice($price);
        
    }

    private function validatePrice(float $price): float
    {
        if ($price <= 0) {
            throw new \InvalidArgumentException("El precio debe ser mayor a 0.");
        }
        return $price;
    }

    public function applyDiscount(float $percentage): void
    {

        if ($percentage === 0) {
            return ;
        }


        if ($percentage < 0 || $percentage > 100) {

            throw new \InvalidArgumentException("El porcentaje no puede ser en negativo o estás colocando un porcentaje mayor a 100.");
        }

        $calculatePercentage = $this->calculatePercentage($percentage);
        $discount = $this->price * $calculatePercentage;

        $this->price -= $discount;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function price(): float
    {
        return $this->price;
    }

    public function priceWithDiscount(): float
    {
        return $this->price;
    }

    public function showInfo(): string
    {
        return "El producto {$this->name} tiene un costo de {$this->price}";
    }

    public function calculatePercentage(float $percentage): float
    {
        return $percentage / 100;
    }
}
