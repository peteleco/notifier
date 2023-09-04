<?php

namespace Peteleco\Notifier\Channels\Teams;

use Illuminate\Support\Collection;
use Peteleco\Notifier\Casts\NullCollectionCast;
use Peteleco\Notifier\Transformers\EmptyArrayTransformer;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Optional;

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
        public readonly DataCollection|null $sections = null,
    ) {
    }

    public static function prepareForPipeline(Collection $properties): Collection
    {
        // Transform default null value as empty array
        if ($properties->only('sections')->isEmpty()) {
            $properties->put('sections',  new DataCollection(Section::class, null));
        }

        return $properties;
    }
}
