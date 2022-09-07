<?php
declare(strict_types=1);


namespace Tests\TradeMarketing\Fixtures;

use App\TradeMarketing\Domain\ValueObjects\Currency\Currency;
use App\TradeMarketing\Domain\ValueObjects\Money;

class MoneyFixture
{
    public static function createRUB($amount): Money
    {
        return new Money($amount, new Currency('RUB'));
    }
}
