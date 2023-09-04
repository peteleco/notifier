<?php

use Illuminate\Http\Response;
use Peteleco\Notifier\Channels\Teams\Fact;
use Peteleco\Notifier\Channels\Teams\MessageCard;
use Peteleco\Notifier\Channels\Teams\Section;
use Peteleco\Notifier\Notifier;
use Peteleco\Notifier\OrderUpdatedMessage;

it('send a basic message', function () {
    $request = app(
        Notifier::class,
        ['webhookUrl' => config('notifier.hooks.orders.updated')]
    )->sendMessage('Hello world!');
    expect($request->status())->toBe(Response::HTTP_OK);
});

it('send a complex message', function () {
    $message = MessageCard::from([
        'summary' => 'Order updated!',
        'sections' => [
            Section::from([
                'activityTitle' => 'Order updated!',
                'activitySubtitle' => '',
                'facts' => [
                    Fact::from([
                        'name' => 'First Fact',
                        'value' => 'Value of First Fact',
                    ]),
                    Fact::from([
                        'name' => 'Second Fact',
                        'value' => 'Value of Second Fact',
                    ]),
                ],
            ]),
        ],
    ]);

    $request = app(
        Notifier::class,
        ['webhookUrl' => config('notifier.hooks.orders.updated')]
    )->send($message);
    expect($request->status())->toBe(Response::HTTP_OK);
});

it('send an order updated message', function () {
    $message = OrderUpdatedMessage::from([
        'uuid' => \Illuminate\Support\Str::uuid(),
        'status' => 'my custom status',
        'updated_at' => \Carbon\Carbon::yesterday()->setHour(18)->setMinutes(30)->setSecond(0)
    ]);
    $request = app(
        Notifier::class,
        ['webhookUrl' => config('notifier.hooks.orders.updated')]
    )->send($message->toMessageCard());
    expect($request->status())->toBe(Response::HTTP_OK);
});