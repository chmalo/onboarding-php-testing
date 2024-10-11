<?php

namespace src\Yeiquel\Product;

class Product 
{
    private string $name;
    private float $price;
    private float $discountPercentage;


    public function __construct(string $name, float $price) 
    {

        $this->name = $name;
        $this->price = $this->validatePrice( $price );
        $this->discountPercentage = 0; 
    }

    private function validatePrice(float $price): float 
    {
        if($price < 0 ) {
            throw new \InvalidArgumentException(message: "The price must be greater than 0.");
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
 
    public function setDiscountPercentage(float $percentage): void 
    {
        if ($percentage < 0 || $percentage > 100) {
            throw new \InvalidArgumentException(  "The discount must be between 0 and 100.");
        }

        $this->discountPercentage = $percentage;
    }
 
    public function applyDiscount(): void
    {
        $discountPercentage = $this->discountPercentage;

        if ($discountPercentage <= 0) {
            return;
        }

        $discount =  $this->price * ( $discountPercentage / 100 );
        
        $this->price -= $discount;
    }
    
    public function showInformation(): string 
    {
        //return "Product: " . $this->name . ", Final Price: $" . $this->price();

        return "Product: {$this->name} , Final Price: $ {$this->price}";
    }
}


/*try {
    $product = new Product("Laptop", -15);
    $product->setDiscountPercentage(10);
    echo $product->showInformation(); 
} catch (\Exception $exception) {
    echo "Error: " . $exception->getMessage();
}*/




