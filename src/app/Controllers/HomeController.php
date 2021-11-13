<?php 

namespace App\Controllers;

use App\App;
use App\Models\ExtraTopping;
use App\Models\Pizza;
use App\View;

class HomeController
{
    public function index(): View
    {
        $pizzas = Pizza::withTypesAndSizes();
        $extraToppings = ExtraTopping::all();
        $cart = App::cart();

        return View::make('index', [
            'pizzas'        => $pizzas, 
            'extraToppings' => $extraToppings,
            'cart'          => $cart->all(),
            'subtotal'      => $cart->subTotal()
        ]);
    }
}