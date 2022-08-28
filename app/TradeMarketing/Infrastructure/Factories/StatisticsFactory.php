<?php
declare(strict_types=1);


namespace App\TradeMarketing\Infrastructure\Factories;

use App\TradeMarketing\Domain\Entities\Statistics;
use App\TradeMarketing\Domain\ValueObjects\Currency\Currency;
use App\TradeMarketing\Domain\ValueObjects\Money;
use App\TradeMarketing\Infrastructure\Models\Statistics as StatisticsModel;
use Carbon\CarbonImmutable;
use DateTimeImmutable;
use InvalidArgumentException;

class StatisticsFactory
{

    /**
     * @param StatisticsModel $statistics
     * @return Statistics
     */
    public static function createFromModel(StatisticsModel $statistics): Statistics
    {
        return self::createFromArray($statistics->toArray());
    }

    /**
     * @param array $array
     * @return Statistics
     */
    public static function createFromArray(array $array): Statistics
    {
        $defaultValues = [
            'clicks' => 0, 'views' => 0, 'cost' => .0
        ];

        $array += $defaultValues;

        $date = $array['date'];
        if (is_string($date)) {
            $date = CarbonImmutable::parse($array['date'])->toDateTimeImmutable();
        }

        if (!$date instanceof DateTimeImmutable) {
            throw new InvalidArgumentException();
        }

        return new Statistics(
            $date,
            $array['views'],
            $array['clicks'],
            new Money($array['cost'], new Currency('RUB'))
        );
    }
}
