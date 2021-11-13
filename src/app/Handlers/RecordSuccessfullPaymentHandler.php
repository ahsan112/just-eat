<?php 

namespace App\Handlers;

use App\Events\Event;
use App\Models\Payment;

class RecordSuccessfullPaymentHandler implements HandlerInterface
{
    private $transactionId;

    public function __construct(string $transactionId)
    {
        $this->transactionId = $transactionId;
    }
    public function handle(Event $event)
    {
        Payment::create([
            'order_id'       => $event->orderId,
            'transaction_id' => $this->transactionId,
            'successfull'    => 1,     
        ]);
        // echo '<pre>';
        //     var_dump('mark payment sucess');
        // echo '</pre>';
    }
}