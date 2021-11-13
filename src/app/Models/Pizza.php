<?php 


namespace App\Models;


class Pizza extends Model
{
    protected static $table = 'pizzas';

    public static function withTypesAndSizes()
    {
        $pizzas = self::nestedEagerLoad(['pizza_types.id, pizza_types.pizza_id, pizza_types.size_id, pizza_types.price, pizza_sizes.size']
                                        ,'pizza_types', 'pizza_id', 'pizza_sizes', 'pizza_sizes.id', 'pizza_types.size_id');
        return $pizzas;
    }
}