<?php 

namespace App\Models;

use App\QueryBuilder;

class OrderItem extends Model
{
    protected static $table = 'order_items';

    public static function withPizzaType(string $id)
    {
        $result = (new QueryBuilder(static::$table))
                ->select(['order_items.*', 'pizza_types.pizza_id', 'pizza_types.size_id', 'pizza_types.price', 'pizza_sizes.size', 'pizzas.name'])
                ->join('pizza_types', 'pizza_types.id', 'order_items.pizza_type_id')
                ->join('pizzas', 'pizzas.id', 'pizza_types.pizza_id')
                ->join('pizza_sizes', 'pizza_sizes.id', 'pizza_types.size_id')
                ->where('order_id', $id)
                ->get();
        return $result;
    }
}