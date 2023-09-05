# Laravel package to notify updated orders on Teams.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/peteleco/notifier.svg?style=flat-square)](https://packagist.org/packages/peteleco/notifier)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/peteleco/notifier/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/peteleco/notifier/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/peteleco/notifier/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/peteleco/notifier/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/peteleco/notifier.svg?style=flat-square)](https://packagist.org/packages/peteleco/notifier)

This module send notification to  Microsoft Teams using a webhook. 

## Installation

You can install the package via composer:

```bash
composer require peteleco/notifier
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="notifier-config"
```

This is the contents of the published config file:

```php
return [
  'hooks'=> [
      'orders' => [
          'updated' => env('NOTIFIER_HOOKS_ORDERS_UPDATED', 'https://webhook.site/bb7586cd-24cb-4336-b648-ceb4fd9c6609'),
          'queue' => env('NOTIFIER_HOOKS_ORDERS_queue', 'default'),
      ]
  ]
];
```

## Usage

```php
$notifier = new Peteleco\Notifier();
echo $notifier->sendMessage('Hello, Peteleco!');

// Or you can send using order message updated object
$message = OrderUpdatedMessage::from([
        'uuid' => \Illuminate\Support\Str::uuid(),
        'status' => 'my custom status',
        'updated_at' => \Carbon\Carbon::yesterday()->setHour(18)->setMinutes(30)->setSecond(0),
    ]);
    $request = app(
        Notifier::class,
        ['webhookUrl' => config('notifier.hooks.orders.updated')]
    )->send($message->toMessageCard());
# The toMessageCard method will format in a teams MessageCard
# https://learn.microsoft.com/en-us/microsoftteams/platform/webhooks-and-connectors/how-to/connectors-using?tabs=cURL
```

### Add this code to your model
```php
    protected static function boot(): void
    {
        parent::boot();
        // Dispatch events
        static::created(function (Order $order) {
            OrderUpdated::dispatch(OrderUpdatedMessage::from([
                'uuid' => $order->getAttribute('uuid'),
                'status' => $order->load('orderStatus')->orderStatus->getAttribute('title'),
                'updated_at' => $order->getAttribute('created_at'),
            ]));
        });

        static::updated(function (Order $order) {
            if($order->wasChanged('order_status_id')) {
                OrderUpdated::dispatch(OrderUpdatedMessage::from([
                    'uuid' => $order->getAttribute('uuid'),
                    'status' =>  $order->load('orderStatus')->orderStatus->getAttribute('title'),
                    'updated_at' => $order->getAttribute('created_at'),
                ]));
            }
        });
    }
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Leonardo Carmo](https://github.com/peteleco)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
