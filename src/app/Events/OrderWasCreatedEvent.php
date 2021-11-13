<?php 

namespace App\Events;

use App\Classes\Cart;

class OrderWasCreatedEvent extends Event
{
    public $orderId;
    public $cart; 

    public function __construct(string $orderId, Cart $cart)
    {
        $this->orderId = $orderId;
        $this->cart = $cart;
    }
}