<?php
declare(strict_types=1);


namespace App\TradeMarketing\Domain\Entities;

use App\TradeMarketing\Domain\ValueObjects\Money;
use DateTimeImmutable;

class Statistics extends Entity
{
    /**
     * @param DateTimeImmutable $date
     * @param int $views
     * @param int $clicks
     * @param Money $cost
     */
    public function __construct(private readonly DateTimeImmutable $date,
                                private readonly int               $views,
                                private readonly int               $clicks,
                                private readonly Money             $cost)
    {
    }

    public function toArray(): array
    {
        return [
            'date' => $this->getDate()->format('Y-m-d'),
            'views' => $this->getViews(),
            'clicks' => $this->getClicks(),
            'cost' => $this->getCost(),
            'cpc' => $this->getCPC(),
            'cpm' => $this->getCPM(),
        ];
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @return int
     */
    public function getViews(): int
    {
        return $this->views;
    }

    /**
     * @return int
     */
    public function getClicks(): int
    {
        return $this->clicks;
    }

    /**
     * @return Money
     */
    public function getCost(): Money
    {
        return $this->cost;
    }

    public function getCPC(): Money
    {
        return $this->cost->safeDivide($this->getClicks());
    }

    public function getCPM(): Money
    {
        return $this->cost->safeDivide($this->getViews());
    }

}
