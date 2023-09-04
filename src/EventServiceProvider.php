<?php

namespace Peteleco\Notifier;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \Peteleco\Notifier\Events\OrderUpdated::class => [
            \Peteleco\Notifier\Listeners\SendOrderUpdatedNotification::class,
        ],
    ];
}