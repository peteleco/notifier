<?php

namespace Peteleco\Notifier\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Peteleco\Notifier\Events\OrderUpdated;
use Peteleco\Notifier\Notifier;
use Peteleco\Notifier\OrderUpdatedMessage;
use Spatie\LaravelData\Contracts\DataObject;

class SendOrderUpdatedNotification implements ShouldQueue
{
    /**
     * @var \Peteleco\Notifier\Notifier
     */
    private Notifier $notifier;

    public function __construct(Notifier $notifier)
    {
        $this->notifier = $notifier;
    }

    public function handle(OrderUpdated $event):void
    {
        $this->notifier->send($event->message);
        return;
    }
}