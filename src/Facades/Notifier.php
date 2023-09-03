<?php

namespace Peteleco\Notifier\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Peteleco\Notifier\Notifier
 */
class Notifier extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Peteleco\Notifier\Notifier::class;
    }
}
