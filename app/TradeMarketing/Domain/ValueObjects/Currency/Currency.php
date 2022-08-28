<?php
declare(strict_types=1);


namespace App\TradeMarketing\Domain\ValueObjects\Currency;

use App\TradeMarketing\Domain\ValueObjects\Currency\Exceptions\InvalidCurrencyException;

/**
 * @method static static RUB()
 * @method static static USD()
 */
class Currency
{

    private static array $currencies = [
        'RUB' => [
            'symbol' => 'руб.',
        ],
        'USD' => [
            'symbol' => 'doll.',
        ],
    ];

    private string $currencyCode;

    /**
     * @param string $currencyCode
     * @throws InvalidCurrencyException
     */
    public function __construct(string $currencyCode)
    {
        if (!isset(self::$currencies[$currencyCode])) {
            $currencyCode = strtoupper($currencyCode);
        }

        if (!isset(self::$currencies[$currencyCode])) {
            throw new InvalidCurrencyException(
                sprintf('Unknown currency code "%s"', $currencyCode)
            );
        }

        $this->currencyCode = $currencyCode;
    }

    /**
     * @throws InvalidCurrencyException
     */
    public static function __callStatic(string $name, array $arguments = []): Currency
    {
        return new self($name);
    }

    /**
     * @param Currency $currency
     * @return bool
     */
    public function equals(Currency $currency): bool
    {
        return $this->getCurrencyCode() === $currency->getCurrencyCode();
    }

    /**
     * @return string
     */
    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    /**
     * @return string
     */
    public function getSymbol(): string
    {
        return self::$currencies[$this->currencyCode]['symbol'];
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->currencyCode;
    }


}
