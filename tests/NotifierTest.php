<?php

use Illuminate\Http\Response;

it('send a basic message', function () {
    $message = app(
        \Peteleco\Notifier\Notifier::class,
        ['webhookUrl' => config('notifier.hooks.orders.updated')]
    )->sendMessage('Hello world!');
    expect($message->status())->toBe(Response::HTTP_OK);
});
