<?php 

namespace App\Exceptions;

use Exception;

class RouteNotFoundException extends Exception
{
    protected $message = 'Route Not Found';
}