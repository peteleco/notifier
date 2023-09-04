<?php

namespace Peteleco\Notifier\Channels\Teams;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class Section extends Data
{
    public function __construct(
        public readonly string $activityTitle,
        public readonly string $activitySubtitle,
        #[DataCollectionOf(Fact::class)]
        public readonly DataCollection $facts,
        public readonly string $activityImage= 'https://adaptivecards.io/content/cats/3.png',
        public readonly bool $markdown = false
    )
    {
    }
}