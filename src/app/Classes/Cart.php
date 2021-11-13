<?php 

namespace App\Classes;

use App\Classes\SessionStorage\SessionStorage;

class Cart 
{
    protected $storage;

    public function __construct(SessionStorage $storage)
    {
        $this->storage = $storage;
    }

    public function add(array $pizza)
    {
        $quantity = $pizza['quantity'];

        if ($this->has($pizza['id'])) {
            $quantity += $this->get($pizza['id'])['quantity'];
        }

        $this->update($pizza, $quantity);
    }

    public function update(array $pizza, string $qty)
    {
        if ($qty == 0) {
            $this->remove($pizza['id']);
            return;
        }

        $this->storage->set($pizza['id'], [
            'pizza_type_id'  => $pizza['id'],
            'name'           => $pizza['name'],
            'size'           => $pizza['size'],
            'price'          => $pizza['price'],
            'extra_toppings' => isset($pizza['extra_toppings']) ? $pizza['extra_toppings'] : null,
            'quantity'       => $qty
        ]);
    }

    public function remove(string $id)
    {
        $this->storage->unset($id);
    }

    public function has(string $id): bool
    {
        return $this->storage->exists($id);
    }

    public function get(string $id): array 
    {
        return $this->storage->get($id);
    }

    public function all(): array
    {
        return $this->storage->all();
    }

    public function subTotal(): float
    {
        $total = 0;
        
        foreach ($this->all() as $pizza) {        
            $toppingsTotal = 0;
            if ($pizza['extra_toppings']) {        
                foreach ($pizza['extra_toppings'] as $topping) {
                    $toppingsTotal += $topping['price'];
                }
            }

            $pizza['price'] += $toppingsTotal;
            $total = $total + $pizza['price'] * $pizza['quantity'];
        }

        return $total;
    }

    public function clear()
    {
        $this->storage->clear();
    }
}