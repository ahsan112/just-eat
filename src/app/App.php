<?php 

namespace App;

use App\Classes\Cart;
use App\Classes\SessionStorage\SessionStorage;
use Braintree\Configuration;

class App 
{
    private $router;
    private $request;
    private $config;
    private static $db;
    private static $cart;

    public function __construct(Router $router, array $request, Config $config)
    {
        $this->router = $router;
        $this->request = $request;
        $this->config = $config;

        static::$db = new DB($config->db);
        static::$cart = new Cart(new SessionStorage('cart'));
    }

    public static function db()
    {
        return static::$db;
    }

    public static function cart()
    {
        return static::$cart;
    }

    public function run()
    {
        Configuration::environment($this->config->braintree['environment']);
        Configuration::merchantId($this->config->braintree['merchantId']);
        Configuration::publicKey($this->config->braintree['publicKey']);
        Configuration::privateKey($this->config->braintree['privateKey']);

        echo $this->router->resolve($this->request['uri'], $this->request['method']);
    }
}