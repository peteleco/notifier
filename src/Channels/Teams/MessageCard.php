<?php

namespace Peteleco\Notifier\Channels\Teams;

use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;

class MessageCard extends Data
{
    public function __construct(
        #[MapOutputName('@type')]
        public readonly string $type = 'MessageCard',
        #[MapOutputName('@context')]
        public readonly string $context = 'http://schema.org/extensions',
        public readonly string $themeColor = '0076D7',
        public readonly string $summary = 'Summary for your notification'
    ) {
    }
}
