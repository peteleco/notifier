<?php

namespace Peteleco\Notifier\Channels\Teams;

use Spatie\LaravelData\Data;

class Fact extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $value,
    )
    {
    }
}