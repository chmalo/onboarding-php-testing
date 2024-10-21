<?php

namespace Php\Tests\Luis;

use Php\Tests\Luis\Product;
use DateTime;

class FoodProduct extends Product
{

    private $discountPercentage;
    private $expirationDate;
    private const FIXED_DISCOUNT = 10;


    public function __construct(
        string $nombre,
        float $price,
        ?float $discountPercentage = 0,
        string $expirationDate
    ) {
        parent::__construct($nombre, $price);
        $this->discountPercentage = $discountPercentage;
        $this->expirationDate = $this->validateExpirationDate($expirationDate);
    }

    public function discountPercentage(): ?float
    {
        return $this->discountPercentage;
    }

    public function applyDiscountFood(): void
    {
        $this->applyDiscount(self::FIXED_DISCOUNT);

        $this->applyDiscountAdditional($this->discountPercentage);
    }

    public function applyDiscountAdditional(?float $discountPercentage): void
    {
        if ($discountPercentage <= 0) {
            return;
        }

        $this->applyDiscount($this->discountPercentage);
    }

    public function validateExpirationDate(string $expirationDate): string
    {
        if (empty($expirationDate)) {
            throw new \InvalidArgumentException("La fecha de expiración es obligatoria.");
        }

        $this->validateDateFormat($expirationDate);
        $this->validateFutureDate($expirationDate);

        return $expirationDate;
    }

    public function validateDateFormat(string $expirationDate): void
    {
        $date = DateTime::createFromFormat('Y-m-d', $expirationDate);

        if (!$date || $date->format('Y-m-d') !== $expirationDate) {
            throw new \InvalidArgumentException("La fecha debe ser válida en formato YYYY-MM-DD.");
        }
    }

    public function validateFutureDate(string $expirationDate): void
    {
        $date = DateTime::createFromFormat('Y-m-d', $expirationDate);
        $currentDate = new DateTime();

        if ($date < $currentDate) {
            throw new \InvalidArgumentException("La fecha de expiración no puede ser anterior a la fecha actual.");
        }
    }
}
