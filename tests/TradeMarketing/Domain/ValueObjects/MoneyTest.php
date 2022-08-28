<?php
declare(strict_types=1);


namespace Tests\TradeMarketing\Domain\ValueObjects;

use App\TradeMarketing\Domain\ValueObjects\Currency\Currency;
use App\TradeMarketing\Domain\ValueObjects\Money;
use Tests\TestCase;

class MoneyTest extends TestCase
{
    public function testCreate()
    {
        $money = new Money(100.55, Currency::RUB());
        $this->assertEquals(100.55, $money->getAmount());
        $this->assertTrue(Currency::RUB()->equals($money->getCurrency()));
    }

    public function testEquals()
    {
        $money = new Money(100.55, Currency::RUB());
        $moneyEquals = new Money(100.55, Currency::RUB());
        $this->assertTrue($money->equals($moneyEquals));
    }

    public function testNotEquals()
    {
        $money = new Money(100.55, Currency::RUB());
        $moneyEquals = new Money(100.55, Currency::USD());
        $this->assertFalse($money->equals($moneyEquals));
    }

    public function testDivide()
    {
        $money = new Money(100.80, Currency::RUB());
        $divided = new Money(50.4, Currency::RUB());
        $this->assertTrue($money->divide(2)->equals($divided));
    }

    public function testSafeDivide()
    {
        $money = new Money(100.80, Currency::RUB());
        $divided = new Money(.0, Currency::RUB());
        $this->assertTrue($money->safeDivide(0)->equals($divided));
    }



}
