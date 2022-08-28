<?php

require_once __DIR__ . '/../vendor/autoload.php';

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    dirname(__DIR__)
))->bootstrap();

date_default_timezone_set(env('APP_TIMEZONE', 'UTC'));

$app = new Laravel\Lumen\Application(
    dirname(__DIR__)
);

// $app->withFacades();
$app->withEloquent();

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    \App\Infrastructure\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    \App\Infrastructure\Console\Kernel::class
);

$app->configure('app');

$app->register(\App\TradeMarketing\Application\Providers\AppServiceProvider::class);
$app->register(\App\TradeMarketing\Application\Providers\RepositoryServiceProvider::class);
$app->register(\App\TradeMarketing\Application\Providers\QueryFilterServiceProvider::class);

return $app;
