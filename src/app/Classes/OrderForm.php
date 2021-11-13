<?php 

namespace App\Classes;

use Respect\Validation\Validator;

class OrderForm
{
    public static function rules()
    {
        return [
            'first_name'  => Validator::alpha(''),
            'last_name'   => Validator::alpha(''),
            'email'       => Validator::email(),
            'address'     => Validator::alnum(' '),
            'city'        => Validator::alpha(' '),
            'postcode'    => Validator::postalCode('GB'),
            'phonenumber' => Validator::phone(),
        ];
    }
}