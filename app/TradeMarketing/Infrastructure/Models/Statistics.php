<?php
declare(strict_types=1);


namespace App\TradeMarketing\Infrastructure\Models;

use App\TradeMarketing\Infrastructure\Factories\StatisticsFactory;
use App\TradeMarketing\Infrastructure\ModelQueryBuilders\StatisticsQueryBuilder;
use DateTimeImmutable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property DateTimeImmutable $date
 * @property int $views
 * @property int $clicks
 * @property float $cost
 *
 * @method static static create(array $attributes = [])
 * @method static StatisticsQueryBuilder query()
 */
class Statistics extends Model
{
    protected $table = 'statistics';

    protected $fillable = [
        'date', 'views', 'cost', 'clicks'
    ];

    protected $casts = [
        'date' => 'immutable_date',
        'views' => 'int',
        'clicks' => 'int',
        'cost' => 'double',
    ];

    /**
     * @param \App\TradeMarketing\Domain\Entities\Statistics $statistics
     * @return void
     */
    public static function createFromEntity(\App\TradeMarketing\Domain\Entities\Statistics $statistics)
    {
        self::create([
            'date' => $statistics->getDate(),
            'views' => $statistics->getViews(),
            'clicks' => $statistics->getClicks(),
            'cost' => $statistics->getCost()->getAmount(),
        ]);
    }

    /**
     * @param $query
     * @return StatisticsQueryBuilder
     */
    public function newEloquentBuilder($query): StatisticsQueryBuilder
    {
        return new StatisticsQueryBuilder($query);
    }

    /**
     * @return \App\TradeMarketing\Domain\Entities\Statistics
     */
    public function toEntity(): \App\TradeMarketing\Domain\Entities\Statistics
    {
        return StatisticsFactory::createFromModel($this);
    }
}
