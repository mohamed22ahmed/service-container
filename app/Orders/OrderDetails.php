<?php

namespace App\Orders;

use App\Billing\PaymentGetway;

class OrderDetails
{
    private $payment;

    public function __construct(PaymentGetway $payment)
    {
        $this->payment = $payment;
    }

    public function all(){
        $this->payment->setDiscount(200);

        return [
            'name' => 'MeMo',
            'address' => 'Asyut, Aboutig'
        ];
    }
}