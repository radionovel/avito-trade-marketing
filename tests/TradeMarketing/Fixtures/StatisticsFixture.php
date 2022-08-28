<?php
declare(strict_types=1);


namespace Tests\TradeMarketing\Fixtures;

use App\TradeMarketing\Domain\Entities\Statistics;
use App\TradeMarketing\Domain\ValueObjects\Currency\Currency;
use App\TradeMarketing\Domain\ValueObjects\Money;

class StatisticsFixture
{
    public static function create($views, $clicks, $cost): Statistics
    {
        return new Statistics(
            new \DateTimeImmutable('2022-01-01'),
            $views,
            $clicks,
            new Money($cost, new Currency('RUB'))
        );
    }

    public static function createOnDate($date, $views, $clicks, $cost): Statistics
    {
        return new Statistics(
            new \DateTimeImmutable($date),
            $views,
            $clicks,
            new Money($cost, new Currency('RUB'))
        );
    }
}
