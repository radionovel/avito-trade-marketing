<?php
declare(strict_types=1);


namespace App\TradeMarketing\Infrastructure\Filters;

use App\TradeMarketing\Infrastructure\ModelQueryBuilders\StatisticsQueryBuilder;

class StatisticsToFilter
{
    public function __invoke(StatisticsQueryBuilder $builder, string $value): void
    {
        $builder->where('date', '<=', $value);
    }
}
