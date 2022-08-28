<?php

namespace App\TradeMarketing\Application\Providers;

use App\TradeMarketing\Domain\Repositories\StatisticsRepositoryInterface;
use App\TradeMarketing\Infrastructure\Repositories\StatisticsRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(StatisticsRepositoryInterface::class, StatisticsRepository::class);
    }
}
