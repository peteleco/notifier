<?php

namespace Peteleco\Notifier;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Peteleco\Notifier\Commands\NotifierCommand;

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
            ->hasViews()
            ->hasMigration('create_notifier_table')
            ->hasCommand(NotifierCommand::class);
        $this->app->register(EventServiceProvider::class);
    }
}
