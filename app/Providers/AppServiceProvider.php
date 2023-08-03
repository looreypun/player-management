<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // \URL::forceScheme('https');
        // $this->app['request']->server->set('HTTPS','on');

        // Get the APP_URL from the .env file
        $appUrl = config('app.url');

        // Check if the environment has '/redzone-dev' in the APP_URL and set the base URL accordingly
        if (!str_contains($appUrl, '/redzone-dev')) {
            config(['app.url' => $appUrl]);
        } else {
            // Set the default base URL for the main application (without '/dev')
            config(['app.url' => rtrim($appUrl, '/').'/redzone-dev']);
        }
    }
}
