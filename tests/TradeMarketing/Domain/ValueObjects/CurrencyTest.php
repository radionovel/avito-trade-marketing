<?php
declare(strict_types=1);


namespace Tests\TradeMarketing\Domain\ValueObjects;

use App\TradeMarketing\Domain\ValueObjects\Currency\Currency;
use App\TradeMarketing\Domain\ValueObjects\Currency\Exceptions\InvalidCurrencyException;
use Tests\TestCase;

class CurrencyTest extends TestCase
{
    public function testCreateLowCase(): void
    {
        $currency = new Currency('rub');
        $this->assertEquals('RUB', $currency->getCurrencyCode());
    }

    public function testCreateInvalidCurrencyCode(): void
    {
        $this->expectException(InvalidCurrencyException::class);
        $currency = new Currency('eur');
        $this->assertEquals('RUB', $currency->getCurrencyCode());
    }

    public function testCreateEquals(): void
    {
        $currencyRub = Currency::RUB();
        $this->assertTrue($currencyRub->equals(Currency::RUB()));
    }

    public function testCreateNotEquals(): void
    {
        $currencyRub = Currency::RUB();
        $this->assertFalse($currencyRub->equals(Currency::USD()));
    }

    public function testSymbol(): void
    {
        $currency = new Currency('rub');
        $this->assertEquals('руб.', $currency->getSymbol());
    }

    public function testToString(): void
    {
        $currency = new Currency('rub');
        $this->assertEquals('RUB', (string)$currency);
    }
}
