<?php

namespace Daikazu\SimpleTokenMiddleware;

use Daikazu\SimpleTokenMiddleware\Http\Middleware\VerifySimpleToken;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const CONFIG_PATH = __DIR__.'/../config/simple-token-middleware.php';

    public function boot()
    {
        $this->publishes([
            self::CONFIG_PATH => config_path('simple-token-middleware.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            self::CONFIG_PATH,
            'simple-token-middleware'
        );

        $this->app->bind('simple-token-middleware', function () {
            return new SimpleTokenMiddleware();
        });

        $this->app['router']->aliasMiddleware('simple.token', VerifySimpleToken::class);
    }
}
