<?php
declare(strict_types=1);


namespace App\TradeMarketing\Infrastructure\Filters;

use Ambengers\QueryFilter\AbstractQueryFilter;

class StatisticsQueryFilter extends AbstractQueryFilter
{
    protected $filters = [
        'from' => StatisticsFromFilter::class,
        'to' => StatisticsToFilter::class,
    ];
}
