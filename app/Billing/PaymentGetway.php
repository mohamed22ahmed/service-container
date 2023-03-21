<?php

namespace App\Billing;
use Str;
class PaymentGetway
{
    private $currency;
    private $discount;

    public function __construct($currency)
    {
        $this->currency = $currency;
        $this->discount = 0;
    }

    public function setDiscount($amount)
    {
        $this->discount = $amount;
    }

    public function charge($amount){
        return [
            'amount' => $amount - $this->discount,
            'billing_number' => Str::random(10),
            'discount' => $this->discount,
            'currency' => $this->currency
        ];
    }
}