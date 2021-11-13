<?php 

namespace App\Controllers;

use App\App;
use App\Classes\OrderCreateService;
use App\Classes\OrderForm;
use App\Classes\PaymentService;
use App\Classes\Validator;
use App\Events\OrderWasCreatedEvent;
use App\Handlers\EmptyCartHandler;
use App\Handlers\MarkOrderPaidHandler;
use App\Handlers\RecordSuccessfullPaymentHandler;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemExtra;
use App\View;


class CheckoutController 
{
    private $cart;
    private $validator;
    private $paymentService;
    private $orderSerivce;

    public function __construct()
    {
        $this->cart = App::cart();
        $this->validator = new Validator();
        $this->paymentService = new PaymentService();
        $this->orderSerivce = new OrderCreateService();
    }

    public function index()
    {
        if (empty($this->cart)) {
            header("Location: /");
        }

        $clientToken = $this->paymentService->getClientToken();
        
        return View::make('checkout', ['cart' => $this->cart->all(), 'total' => $this->cart->subTotal(), 'token' => $clientToken]);
    }

    public function order()
    {
        $nonceFromTheClient = $_POST['payment_method_nonce'];
        unset($_POST['payment_method_nonce']);

        $validation = $this->validator->validate($_POST, OrderForm::rules());

        if ($validation->fails()) {
        }

        $orderId = $this->orderSerivce->create($_POST);
        $result  = $this->paymentService->charge($this->cart->subTotal(), $nonceFromTheClient);
        
        $this->dispatchOrderCreatedEvents($orderId, $result);

        header("Location: /checkout/success?hash=" . $orderId);        
    }

    public function success()
    {
        $order = Order::findWithCustomer('orders.id', $_GET['hash']);
        $orderItems = OrderItem::withPizzaType($order['id']);


        $orderItemsIds = [];
        foreach ($orderItems as $orderItem) {
            $orderItemsIds[] = $orderItem['id'];
        }

        $extras = OrderItemExtra::whereInWith('order_id', $orderItemsIds, 'extra_toppings', 'extra_toppings.id', 'order_item_extras.extra_toppings_id' );


        $groupedEagerLoadData = [];
        foreach ($extras as $data) {
            $groupedEagerLoadData[$data['order_id']][] = $data;
        }

        $dataToReturn = [];

        foreach ($orderItems as $data) {
            if (isset($groupedEagerLoadData[$data['id']])) {
                $data['extra_toppings'] = $groupedEagerLoadData[$data['id']]; 
            } else {
                $data['extra_toppings'] = null;
            }
            $dataToReturn[] = $data;
        }

        $order['order_items'] = $dataToReturn;

        return View::make('success', ['order' => $order]);
    }

    private function dispatchOrderCreatedEvents(string $orderId, $result)
    {
        $event = new OrderWasCreatedEvent($orderId, $this->cart);

        $event->attach([
            new EmptyCartHandler,
            new MarkOrderPaidHandler,
            new RecordSuccessfullPaymentHandler($result->transaction->id)
        ]);

        $event->dispatch();
    }
}