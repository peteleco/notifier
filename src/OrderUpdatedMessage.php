<?php

namespace Peteleco\Notifier;

use DateTimeInterface;
use Spatie\LaravelData\Data;

class OrderUpdatedMessage extends Data
{
    public function __construct(
        public readonly string $uuid,
        public readonly string $status,
        public readonly DateTimeInterface $updated_at
    )
    {
    }
}