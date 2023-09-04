<?php

namespace Peteleco\Notifier;

use DateTimeInterface;
use Peteleco\Notifier\Channels\Teams\Fact;
use Peteleco\Notifier\Channels\Teams\MessageCard;
use Peteleco\Notifier\Channels\Teams\Section;
use Spatie\LaravelData\Data;

class OrderUpdatedMessage extends Data
{
    public function __construct(
        public readonly string $uuid,
        public readonly string $status,
        public readonly DateTimeInterface $updated_at
    ) {
    }

    public function toMessageCard(): MessageCard
    {
        return MessageCard::from([
            'summary' => 'Order updated!',
            'sections' => [
                Section::from([
                    'activityTitle' => 'Order updated!',
                    'activitySubtitle' => '',
                    'facts' => [
                        Fact::from([
                            'name' => 'Order UUID',
                            'value' => $this->uuid,
                        ]),
                        Fact::from([
                            'name' => 'New status',
                            'value' => $this->status,
                        ]),
                        Fact::from([
                            'name' => 'Updated at',
                            'value' => $this->updated_at->format(DateTimeInterface::RFC2822),
                        ]),
                    ],
                ]),
            ],
        ]);
    }
}
