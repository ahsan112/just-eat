<?php 

namespace App\Classes;

use Braintree;
use Braintree\Configuration;

class PaymentService 
{
    private $braintreeGateway;

    public function __construct()
    {
        $this->braintreeGateway = Configuration::gateway();
    }

    public function getClientToken(): string
    {
        return $this->braintreeGateway->clientToken()->generate();
    }

    public function charge(string $amount, string $nonce)
    {
        $result = $this->braintreeGateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
              'submitForSettlement' => true
            ]
        ]);

        return $result;
    }
}