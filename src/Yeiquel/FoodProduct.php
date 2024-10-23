<?php

namespace Php\Yeiquel;

class FoodProduct extends Product
{
    private string $expirationDate;

    private const FIXED_DISCOUNT = 10.0;

    public function __construct(string $name, float $price, string $expirationDate)
    {
        parent::__construct($name, $price);
        $this->setExpirationDate($expirationDate);
        $this->applyDiscount();
    }

    public function setDiscountPercentage(float $percentage): void
    {
        $this->discountPercentage += $percentage;
    }

    public function applyDiscount(): void
    {
        $this->discountPercentage = self::FIXED_DISCOUNT;
        $this->applyDiscount();
    }

    public function setExpirationDate(string $expirationDate): void
    {
        if (!$this->validDate($expirationDate)) {
            throw new \InvalidArgumentException("La fecha de expiración no es válida. Debe estar en formato YYYY-MM-DD.");
        }

        if (new \DateTime($expirationDate) <= new \DateTime()) {
            throw new \InvalidArgumentException("La fecha de expiración debe ser una fecha futura.");
        }

        $this->expirationDate = $expirationDate;
    }

    public function getExpirationDate(): string
    {
        return $this->expirationDate;
    }

    private function validDate(string $validDate): bool
    {
        $date = \DateTime::createFromFormat('Y-m-d', $validDate);
        return $date && $date->format('Y-m-d') === $validDate;
    }
}
