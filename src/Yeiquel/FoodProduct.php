<?php

namespace Php\Yeiquel;

class FoodProduct extends Product
{
    private string $expirationDate;

    private const FIXED_DISCOUNT = 10.0;
    private float $aditionalPercentage;

    public function __construct(string $name, float $price, string $expirationDate, float $aditionalPercentage = 0)
    {
        parent::__construct($name, $price);
        $this->expirationDate = $this->validateExpirationDate($expirationDate);
        $this->aditionalPercentage = $aditionalPercentage;
    }

    public function applyDiscountFoodProduct(): void
    {
        $this->setDiscountPercentage(self::FIXED_DISCOUNT);
        $this->applyDiscount();
        $this->applyDiscountAditional();
    }

    public function applyDiscountAditional()
    {
        if ($this->aditionalPercentage <= 0) {
            return;
        }

        $this->setDiscountPercentage($this->aditionalPercentage);
        $this->applyDiscount();
    }

    public function validateExpirationDate(string $expirationDate): string
    {
        $date = \DateTime::createFromFormat('Y-m-d', $expirationDate);

        if (!$date || $date->format('Y-m-d') !== $expirationDate) {
            throw new \InvalidArgumentException("La fecha de expiración no es válida. Debe estar en formato YYYY-MM-DD.");
        }

        if (new \DateTime($expirationDate) <= new \DateTime()) {
            throw new \InvalidArgumentException("La fecha de expiración debe ser una fecha futura.");
        }

        return $expirationDate;
    }

    public function ExpirationDate(): string
    {
        return $this->expirationDate;
    }

}
