<?php

use Illuminate\Support\Facades\Event;
use Peteleco\Notifier\Events\OrderUpdated;
use Peteleco\Notifier\OrderUpdatedMessage;

it('order updated', function () {
    Event::fake();

    // Perform order shipping...
    OrderUpdated::dispatch($orderMessage = OrderUpdatedMessage::from([
        'uuid' => \Illuminate\Support\Str::uuid(),
        'status' => 'my order status',
        'updated_at' => \Carbon\Carbon::now()
    ]));

    Event::assertDispatched(function (OrderUpdated $event) use ($orderMessage) {
        return $event->message->uuid === $orderMessage->uuid;
    });

    // Assert that an event was dispatched...
    Event::assertDispatched(OrderUpdated::class);
});