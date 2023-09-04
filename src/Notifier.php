<?php

namespace Peteleco\Notifier;

use Illuminate\Support\Facades\Http;
use Peteleco\Notifier\Channels\Teams\MessageCard;
use Spatie\LaravelData\Contracts\DataObject;

class Notifier
{
    public const SUCCESS = 1;

    public const ERROR = 2;

    public function __construct(
        public readonly string $webhookUrl
    ) {
    }

    public function sendMessage(string $message): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {
        return $this->send(MessageCard::from(['summary' => $message, 'sections' => null]));
    }

    public function send(DataObject $messageCard): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {
        return Http::asJson()->post(
            $this->webhookUrl,
            $messageCard
        );
    }
}
