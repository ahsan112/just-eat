<?php 

namespace App\Classes;

use App\App;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemExtra;

class OrderCreateService
{
    private $cart;

    public function __construct()
    {
        $this->cart = App::cart();
    }

    public function create(array $request): string
    {
         $customer = Customer::firstOrCreate('email', $request['email'], $request);
        
         $orderID = Order::create([
            'hash'        => bin2hex(random_bytes(32)),
            'customer_id' => (int) $customer['id'], 
            'total'       => (float) $this->cart->subTotal(),
         ]);

        $this->createOrderItems($orderID);

        return $orderID;
    }

    private function createOrderItems(string $orderId): void
    {
        $items = [];
        foreach ($this->cart->all() as $item) {
            if ($item['extra_toppings']) {
                $orderItemId = OrderItem::create($this->buildOrderItem($item, $orderId));
                $this->createOrderItemExtras($item['extra_toppings'], $orderItemId);
                continue;
            }
            $item['order_id'] = $orderId;
            $items[] = $item;
        }

        OrderItem::createMany($this->buildOrderItems($items, $orderId));
    }

    private function createOrderItemExtras(array $extras, string $orderId): void
    {   
        $items = [];

        foreach ($extras as $extra) {
            $item = [];
            $item['order_id'] = $orderId;
            $item['extra_toppings_id'] = $extra['id'];
            $items[] = $item;
        }

        OrderItemExtra::createMany($items);
    }

    private function buildOrderItems(array $orderItems, string $orderId): array
    {
        $items = [];
        foreach ($orderItems as $orderItem) {
            $item = [];
            $item['order_id'] = $orderId;
            $item['pizza_type_id'] = $orderItem['pizza_type_id'];
            $item['qty'] = $orderItem['quantity'];
            $items[] = $item;
        }
        return $items;
    }
    
    private function buildOrderItem(array $orderItem, string $orderId): array
    {
        return [
            'order_id'      => $orderId,
            'pizza_type_id' => $orderItem['pizza_type_id'],
            'qty'           => $orderItem['quantity']
        ];
    }
}