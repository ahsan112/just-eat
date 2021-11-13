<?php 

namespace App\Handlers;

use App\Events\Event;

interface HandlerInterface 
{
    public function handle(Event $event);
}