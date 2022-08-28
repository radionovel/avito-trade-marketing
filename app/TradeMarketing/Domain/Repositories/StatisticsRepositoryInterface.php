<?php
declare(strict_types=1);


namespace App\TradeMarketing\Domain\Repositories;

use App\TradeMarketing\Domain\Entities\Statistics;

interface StatisticsRepositoryInterface
{
    public function add(Statistics $statistics);

    public function paginate($filter): mixed;

    public function clear();
}
