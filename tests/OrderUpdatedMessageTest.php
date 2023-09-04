<?php

use Peteleco\Notifier\OrderUpdatedMessage;

it('match order updated structure', function (){

        $message = OrderUpdatedMessage::from([
            'uuid' => $uuid = \Illuminate\Support\Str::uuid(),
            'status' => $myCustomStatus = 'my custom status',
            'updated_at' => $updatedAt = \Carbon\Carbon::yesterday()->setHour(18)->setMinutes(30)->setSecond(0),
        ]);
        expect($message->toJson())->toBe(
            "{\"uuid\":\"$uuid\",\"status\":\"$myCustomStatus\",\"updated_at\":\"{$updatedAt->toAtomString()}\"}"
        );
});

it('match order updated message card structure', function (){

    $message = OrderUpdatedMessage::from([
        'uuid' => $uuid = \Illuminate\Support\Str::uuid(),
        'status' => $myCustomStatus = 'my custom status',
        'updated_at' => $updatedAt = \Carbon\Carbon::yesterday()->setHour(18)->setMinutes(30)->setSecond(0),
    ]);
    expect($message->toMessageCard()->toJson())->toBe(
        "{\"@type\":\"MessageCard\",\"@context\":\"http:\/\/schema.org\/extensions\",\"themeColor\":\"0076D7\",\"summary\":\"Order updated!\",\"sections\":[{\"activityTitle\":\"Order updated!\",\"activitySubtitle\":\"\",\"facts\":[{\"name\":\"Order UUID\",\"value\":\"$uuid\"},{\"name\":\"New status\",\"value\":\"$myCustomStatus\"},{\"name\":\"Updated at\",\"value\":\"{$updatedAt->format(DateTimeInterface::RFC2822)}\"}],\"activityImage\":\"https:\/\/adaptivecards.io\/content\/cats\/3.png\",\"markdown\":false}]}"
    );
});