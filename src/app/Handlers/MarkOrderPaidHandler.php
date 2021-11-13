<?php 

namespace App\Handlers;

use App\Events\Event;
use App\Models\Order;

class MarkOrderPaidHandler implements HandlerInterface
{
    public function handle(Event $event)
    {

        Order::paid($event->orderId);
        // echo '<pre>';
        //     var_dump('mark order paid');
        // echo '</pre>';
        
    }
}