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

        if (str_ends_with($appUrl, '/redzone-dev')) {
            $this->app['url']->setBaseUrl($appUrl . '/redzone-dev');
        } else {
            $this->app['url']->setBaseUrl($appUrl);
        }
    }
}
