<?php

namespace Easyship\Providers;

use Easyship\EasyshipAPI;
use Easyship\Webhooks\Handler;
use Illuminate\Support\ServiceProvider;

class EasyshipServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/easyship.php',
            'easyship'
        );

        $this->publishes([
            __DIR__.'/../../config/easyship.php' => config_path(
                'easyship.php'
            ),
        ], 'config');
    }

    public function register()
    {
        $this->app->singleton(EasyshipAPI::class, function ($app) {
            $easyship = new EasyshipAPI(
                config('easyship.api_token'),
                config('easyship.request_options')
            );
            if ($host = config('easyship.host')) {
                $easyship->setApiHost($host);
            }

            return $easyship;
        });
        $this->app->alias(EasyshipAPI::class, 'easyship.api');

        $this->app->singleton(Handler::class, function ($app) {
            return new Handler(...config('easyship.webhook_secrets'));
        });
        $this->app->alias(Handler::class, 'easyship.handler');
    }
}
