<?php

session_start();

use App\App;
use App\Config;
use App\Controllers\CartController;
use App\Controllers\CheckoutController;
use App\Controllers\HomeController;
use App\Router;
use Dotenv\Dotenv;

require_once __DIR__ . '../../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

define('VIEW_PATH', __DIR__ . '../../views');


$router = new Router();

$router
    ->get('/', [HomeController::class, 'index'])
    ->post('/cart/add', [CartController::class, 'add'])
    ->post('/cart/delete', [CartController::class, 'remove'])
    ->get('/checkout', [CheckoutController::class, 'index'])
    ->post('/checkout', [CheckoutController::class, 'order'])
    ->get('/checkout/success', [CheckoutController::class, 'success']);

$app = new App(
    $router, 
    ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
    new Config
);

$app->run();