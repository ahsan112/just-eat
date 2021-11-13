<?php 


namespace App\Classes;

use App\App;
use App\Models\ExtraTopping;
use App\Models\PizzaType;

class CartService 
{
    private $cart;

    public function __construct()
    {
        $this->cart = App::cart();
    }

    public function add(array $request)
    {
        $pizza = $this->loadProduct($request);
        $this->cart->add($pizza);
    }

    public function remove(string $id)
    {
        $this->cart->remove($id);
    }

    private function loadProduct(array $request): array
    {
        $pizza = PizzaType::withPizzaAndSize($request['pizza_type_id']);
        $pizza['quantity'] = $request['qty'];
        $pizza['price'] = $pizza['price'] * $pizza['quantity'];

        if (isset($request['extra_toppings'])) {
            $total = 0;
            $extraToppings = ExtraTopping::whereIn('id', $request['extra_toppings']);
            foreach ($extraToppings as $topping) {
                $total += $topping['price'] * $pizza['quantity'];
            }
            $pizza['extra_toppings'] = $extraToppings;
            $pizza['price'] =  $pizza['price'] + $total;
        }

        $pizza['price'] = number_format((float)$pizza['price'], 2, '.', '');

        return $pizza;
    }
}