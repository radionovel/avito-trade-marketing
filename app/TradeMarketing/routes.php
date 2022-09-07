<?php


/** @var Router $router */

use App\TradeMarketing\Application\{Controllers\GetStatisticsController};
use App\TradeMarketing\Application\Controllers\CreateStatisticsController;
use App\TradeMarketing\Application\Controllers\DeleteStatisticsController;
use Laravel\Lumen\Routing\Router;

$router->group(['prefix' => '/api/v1'], function (Router $router) {
    $router->get('/statistics', GetStatisticsController::class);
    $router->post('/statistics', CreateStatisticsController::class);
    $router->delete('/statistics', DeleteStatisticsController::class);
});
