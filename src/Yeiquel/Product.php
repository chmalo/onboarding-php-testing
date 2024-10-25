<?php

namespace Php\Yeiquel;

class Product
{
    private string $name;
    public float $price;
    public float $discountPercentage;

    public function __construct(string $name, float $price)
    {
        $this->name = $name;
        $this->price = $this->validatePrice($price);
        $this->discountPercentage = 0;
    }

    private function validatePrice(float $price): float
    {
        if ($price < 0) {
            throw new \InvalidArgumentException("The price must be greater than 0.");
        }
        return $price;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function price(): float
    {
        return $this->price;
    }

    public function discountPercentage(): float
    {
        return $this->discountPercentage;
    }

    public function priceWithDiscount(): float
    {
        return $this->price;
    }

    public function setDiscountPercentage(float $percentage): void
    {
        if ($percentage < 0 || $percentage > 100) {
            throw new \InvalidArgumentException("The discount must be between 0 and 100.");
        }
        $this->discountPercentage = $percentage;
    }

    public function applyDiscount(): void
    {
        $discountPercentage = $this->discountPercentage;
        if ($discountPercentage <= 0) {
            return;
        }
        $discount = $this->price * ($discountPercentage / 100);
        $this->price -= $discount;
    }

    public function showInformation(): string
    {
        return "Product: {$this->name}, Final Price: $ {$this->price}";
    }

    public function calculatePercentage(float $percentage): float
    {
        return $percentage / 100;
    }
}
