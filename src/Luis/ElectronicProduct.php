<?php

namespace Php\Tests\Luis;

use Php\Tests\Luis\Product;
use Datetime;

class ElectronicProduct extends Product
{

    private $warranty;
    private $discountPercentage;
    private $expirationDate;
    private const WARRANTY_MIN_DISCOUNT = 24;
    private const DISCOUNT_ADDITIONAL_PERCENTAGE = 10;
    

    public function __construct(
        string $name,
        float $price,
        ?int $warranty = 0,
        ?float $discountPercentage = 0,
        string $expirationDate

    ) {
        parent::__construct($name, $price);
        $this->price =  $this->validatePriceElectronic($price);
        $this->warranty = $this->validateWarranty($warranty);
        $this->discountPercentage = $discountPercentage;
        $this->expirationDate = $this->validateExpirationDate($expirationDate);
    }

    public function validatePriceElectronic(float $price): float
    {
        if ($price < 100) {
            throw new \InvalidArgumentException("El precio de los electrónicos no puede ser menor a $100.");
        }

        return $price;
    }

    public function warranty(): ?int
    {
        return $this->warranty;
    }

    public function discountPercentage(): ?float
    {
        return $this->discountPercentage;
    }

    public function applyDiscountElectronic(): void
    {

        if ($this->discountPercentage > 20) {
            throw new \InvalidArgumentException("El descuento no puede ser mayor al 20%.");
        }

        $this->applyDiscount($this->discountPercentage);

        $this->applyDiscountWarranty();

        if ($this->priceWithDiscount() < 100) {
            throw new \InvalidArgumentException("El precio de los electrónicos no puede ser menor a $100 después del descuento.");
        }
    }

    public function validateWarranty(int $warranty): int
    {
        $this->validateNegativeWarranty($warranty);
        $this->validateWarrantyRange($warranty);

        return $warranty;
    }

    public function validateNegativeWarranty(int $warranty): void
    {
        if ($warranty < 0) {

            throw new \InvalidArgumentException("El valor de la garantía debe ser mayor a 0.");
        }
    }

    public function validateWarrantyRange(int $warranty): void
    {
        if ($warranty > 36) {
            throw new \InvalidArgumentException("El valor de la garantía no debe ser mayor a los 36 meses.");
        }
    }

    public function applyDiscountWarranty(): void
    {

        if ($this->warranty < self::WARRANTY_MIN_DISCOUNT) {
            return;
        }

        $calculatePercentage = $this->calculatePercentage(self::DISCOUNT_ADDITIONAL_PERCENTAGE);
        $additionalDiscount = $this->price * $calculatePercentage;
        
        $this->price -= $additionalDiscount;
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
