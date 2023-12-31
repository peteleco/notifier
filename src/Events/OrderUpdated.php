<?php

namespace Peteleco\Notifier\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Peteleco\Notifier\OrderUpdatedMessage;

class OrderUpdated
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public function __construct(public readonly OrderUpdatedMessage $message)
    {
    }
}
