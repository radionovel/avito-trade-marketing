<?php
declare(strict_types=1);


namespace App\TradeMarketing\Domain\ValueObjects;

use App\TradeMarketing\Domain\ValueObjects\Currency\Currency;
use JsonSerializable;

class Money implements JsonSerializable
{
    private float $amount;
    private Currency $currency;

    /**
     * @param float $amount
     * @param Currency $currency
     */
    public function __construct(float $amount, Currency $currency)
    {
        $this->amount = round($amount, 2);
        $this->currency = $currency;
    }

    public function safeDivide(float $divider): Money
    {
        if ($divider === .0) {
            return new Money(0, $this->getCurrency());
        }

        return $this->divide($divider);
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function divide(float $divider): Money
    {
        $quotient = round($this->getAmount() / $divider, 2);
        return new Money($quotient, $this->getCurrency());
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function equals(Money $money): bool
    {
        if (!$this->getCurrency()->equals($money->currency)) {
            return false;
        }

        return $this->getAmount() === $money->getAmount();
    }

    public function jsonSerialize(): string
    {
        return $this->__toString();
    }

    public function __toString()
    {
        return sprintf('%s %s', $this->getAmount(), $this->currency->getSymbol());
    }
}
