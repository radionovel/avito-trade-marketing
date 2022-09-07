<?php

namespace App\TradeMarketing\Application\Providers;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * @return void
     * @throws BindingResolutionException
     */
    public function register(): void
    {
        $router = $this->app->make('router');
        $router->group([], function ($router) {
            require __DIR__ . '/../../routes.php';
        });
    }
}
