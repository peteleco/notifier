<?php

namespace Peteleco\Notifier\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Peteleco\Notifier\Events\OrderUpdated;
use Peteleco\Notifier\Notifier;

class SendOrderUpdatedNotification implements ShouldQueue
{
    private Notifier $notifier;

    public function __construct(Notifier $notifier)
    {
        $this->notifier = $notifier;
    }

    public function handle(OrderUpdated $event): void
    {
        $this->notifier->send($event->message->toMessageCard());
    }
}
