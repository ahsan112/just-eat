<?php 


namespace App\Events;

use App\Handlers\HandlerInterface;

class Event 
{
    protected $handlers = [];

    public function attach(array $handlers)
    {
        foreach($handlers as $handler) {
            if (! $handler instanceof HandlerInterface) {
                continue;
            }

            $this->handlers[] = $handler;
        }

    }

    public function dispatch()
    {
        foreach($this->handlers as $handler) {
            $handler->handle($this);
        }
    }
}