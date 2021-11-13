<?php 


namespace App\Models;

use App\QueryBuilder;

class PizzaType extends Model
{
    protected static $table = 'pizza_types';

    public static function withPizzaAndSize(string $id)
    {

        $result = (new QueryBuilder(static::$table))
                ->select(['pizza_types.id, pizza_types.pizza_id, pizza_types.size_id, pizza_types.price, pizzas.name, pizza_sizes.size'])
                ->join('pizzas', 'pizzas.id', 'pizza_types.pizza_id')
                ->join('pizza_sizes', 'pizza_sizes.id', 'pizza_types.size_id')
                ->where('pizza_types.id', $id)
                ->get();
                
        return $result[0];
    }
}