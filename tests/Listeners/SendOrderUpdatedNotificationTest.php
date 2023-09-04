<?php

use Illuminate\Support\Facades\Event;
use Peteleco\Notifier\Events\OrderUpdated;
use Peteleco\Notifier\Listeners\SendOrderUpdatedNotification;
use Peteleco\Notifier\OrderUpdatedMessage;

it('send order updated notification', function (){
    Event::fake();
    OrderUpdated::dispatch($orderMessage = OrderUpdatedMessage::from([
        'uuid' => \Illuminate\Support\Str::uuid(),
        'status' => 'my order status',
        'updated_at' => \Carbon\Carbon::now()
    ]));
    Event::assertListening(
        OrderUpdated::class,
        SendOrderUpdatedNotification::class
    );
});