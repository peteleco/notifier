<?php

namespace Peteleco\Notifier;

use Peteleco\Notifier\Commands\NotifierCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class NotifierServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('notifier')
            ->hasConfigFile()
            ->hasViews();
        // ->hasMigration('create_notifier_table')
        // ->hasCommand(NotifierCommand::class)
        $this->app->bind(Notifier::class, function (\Illuminate\Contracts\Foundation\Application $app) {
            return new Notifier(config('notifier.hooks.orders.updated'));
        });
        $this->app->register(EventServiceProvider::class);
    }
}
