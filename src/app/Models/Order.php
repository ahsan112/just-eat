<?php 

namespace App\Models;

use App\QueryBuilder;

class Order extends Model
{
    protected static $table = 'orders';

    public static function paid(string $id)
    {
        $sql = 'UPDATE ' . self::$table . ' SET paid = 1' . ' WHERE id = ' . $id; 

        self::raw($sql);
    }

    public static function findWithCustomer(string $column, string $value)
    {
        $order = (new QueryBuilder(static::$table))
                ->select(['orders.*', 'customers.first_name', 'customers.last_name', 'customers.email', 'customers.phonenumber', 'customers.address', 'customers.city', 'customers.postcode'])
                ->join('customers', 'customers.id', 'orders.customer_id')
                ->where($column, $value)
                ->get();

        return $order[0] ?? [];
    }
}