<?php 

namespace App\Handlers;

use App\Events\Event;

class EmptyCartHandler implements HandlerInterface
{
    public function handle(Event $event)
    {
        $event->cart->clear();
        // echo '<pre>';
        //     var_dump('empty the cart');
        // echo '</pre>';
    }
}