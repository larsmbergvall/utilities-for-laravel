<?php

namespace Larsmbergvall\UtilitiesForLaravel;

use Illuminate\Support\ServiceProvider;
use Larsmbergvall\UtilitiesForLaravel\Commands\MakeActionCommand;

class UtilitiesForLaravelServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/utilities-for-laravel.php',
            'utilities-for-laravel'
        );

        $this->commands([
            MakeActionCommand::class,
        ]);
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/stubs/action.stub' => $this->app->basePath('stubs/action.stub'),
        ], 'utilities-for-laravel-stubs');

        $this->publishes([
            __DIR__ . '/config/utilities-for-laravel.php' => $this->app->configPath('utilities-for-laravel.php'),
        ], 'utilities-for-laravel-config');
    }
}