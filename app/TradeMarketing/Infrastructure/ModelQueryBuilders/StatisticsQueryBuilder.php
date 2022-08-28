<?php
declare(strict_types=1);


namespace App\TradeMarketing\Infrastructure\ModelQueryBuilders;

use Ambengers\QueryFilter\RequestQueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * @method Collection|Model|LengthAwarePaginator filter(RequestQueryBuilder $filters)
 */
class StatisticsQueryBuilder extends Builder
{

}
