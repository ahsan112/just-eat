<?php 


namespace App\Controllers;

use App\Classes\CartService;

class CartController 
{
    protected $cartService;

    public function __construct()
    {
        $this->cartService = new CartService();
    }

    public function add()
    {   
        $this->cartService->add($_POST);
        header("Location: /");
    }

    public function remove()
    {
        $this->cartService->remove($_POST['id']);
        header("Location: /");
    }
}