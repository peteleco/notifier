<?php

namespace Peteleco\Notifier\Channels\Teams;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class MessageCard extends Data
{
    public function __construct(
        #[MapOutputName('@type')]
        public readonly string $type = 'MessageCard',
        #[MapOutputName('@context')]
        public readonly string $context = 'http://schema.org/extensions',
        public readonly string $themeColor = '0076D7',
        public readonly string $summary = 'Summary for your notification',
        #[DataCollectionOf(Section::class)]
        public readonly ?DataCollection $sections = null,
    ) {
    }

    public static function prepareForPipeline(Collection $properties): Collection
    {
        // Transform default null value as empty array
        if ($properties->only('sections')->isEmpty() || !$properties->get('sections')) {
            $properties->put('sections', new DataCollection(Section::class, null));
        }

        return $properties;
    }
}
