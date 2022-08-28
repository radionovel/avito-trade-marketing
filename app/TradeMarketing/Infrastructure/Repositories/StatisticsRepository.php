<?php
declare(strict_types=1);


namespace App\TradeMarketing\Infrastructure\Repositories;

use App\TradeMarketing\Domain\Entities\Statistics;
use App\TradeMarketing\Domain\Repositories\StatisticsRepositoryInterface;
use App\TradeMarketing\Infrastructure\Filters\StatisticsQueryFilter;
use App\TradeMarketing\Infrastructure\Models\Statistics as StatisticsModel;
use Illuminate\Pagination\LengthAwarePaginator;

class StatisticsRepository implements StatisticsRepositoryInterface
{
    /**
     * @param Statistics $statistics
     * @return void
     */
    public function add(Statistics $statistics): void
    {
        StatisticsModel::createFromEntity($statistics);
    }

    /**
     * @param StatisticsQueryFilter $filter
     * @return LengthAwarePaginator
     */
    public function paginate($filter): LengthAwarePaginator
    {
        return StatisticsModel::query()
            ->orderBy('date')
            ->filter($filter)
            ->through(function (StatisticsModel $statistics) {
                return $statistics->toEntity();
            });
    }

    /**
     * @return void
     */
    public function clear(): void
    {
        StatisticsModel::query()->truncate();
    }
}
