<?php

namespace ApiLens\Laravel\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use ApiLens\Core\Tracker;
use ApiLens\Core\Transport\TransportInterface;
use ApiLens\Core\Transport\LogTransport;
use ApiLens\Core\Transport\DatabaseTransport;
use ApiLens\Laravel\Middleware\TrackApiRequests;

class ApiLensServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Merge config
        $this->mergeConfigFrom(
            __DIR__.'/../../../config/apilens.php',
            'apilens'
        );

        // Bind transport
        $this->app->singleton(TransportInterface::class, function () {
            $transport = config('apilens.transport');

            return $transport === 'database'
                ? new DatabaseTransport()
                : new LogTransport();
        });

        // Bind tracker
        $this->app->singleton(Tracker::class, function ($app) {
            return new Tracker($app->make(TransportInterface::class));
        });
    }

    public function boot(): void
    {
        // Load routes
        $this->loadRoutesFrom(__DIR__.'/../../../routes/web.php');

        // Load views
        $this->loadViewsFrom(
            __DIR__.'/../../../resources/views',
            'apilens'
        );

        // Load migrations
        $this->loadMigrationsFrom(
            __DIR__.'/../../../database/migrations'
        );

        // Publish config
        $this->publishes([
            __DIR__.'/../../../config/apilens.php' => config_path('apilens.php'),
        ], 'apilens-config');

        // Publish migrations (optional)
        $this->publishes([
            __DIR__.'/../../../database/migrations/' => database_path('migrations')
        ], 'apilens-migrations');

        if ($this->app->runningInConsole()) {
            $this->commands([
                \ApiLens\Laravel\Console\InstallCommand::class,
            ]);
        }

        // Register middleware
        $this->app->booted(function () {
            $router = $this->app->make(Router::class);

            $router->pushMiddlewareToGroup('web', TrackApiRequests::class);

            // Apply to api ONLY if exists
            if (isset($router->getMiddlewareGroups()['api'])) {
                $router->pushMiddlewareToGroup('api', TrackApiRequests::class);
            }
        });
    }
}