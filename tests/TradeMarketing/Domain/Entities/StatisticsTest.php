<?php
declare(strict_types=1);


namespace Tests\TradeMarketing\Domain\Entities;

use Tests\TestCase;
use Tests\TradeMarketing\Fixtures\MoneyFixture;
use Tests\TradeMarketing\Fixtures\StatisticsFixture;

class StatisticsTest extends TestCase
{

    public function testCreate()
    {
        $instance = StatisticsFixture::createOnDate('2022-01-01', 100, 50, 50);
        $this->assertEquals('2022-01-01', $instance->getDate()->format('Y-m-d'));
        $this->assertEquals(100, $instance->getViews());
        $this->assertEquals(50, $instance->getClicks());
        $this->assertTrue($instance->getCost()->equals(MoneyFixture::createRUB(50)));
    }

    /**
     * @param $instance
     * @param $cpcCost
     * @return void
     *
     * @dataProvider statisticsCPCDataProvider
     */
    public function testCPC($instance, $cpcCost): void
    {
        $cpc = $instance->getCPC();
        $cost = MoneyFixture::createRUB($cpcCost);
        $this->assertTrue($cost->equals($cpc));
    }

    /**
     * @param $instance
     * @param $cpmCost
     * @return void
     *
     * @dataProvider statisticsCPMDataProvider
     */
    public function testCPM($instance, $cpmCost): void
    {
        $cpm = $instance->getCPM();
        $cost = MoneyFixture::createRUB($cpmCost);
        $this->assertTrue($cost->equals($cpm));
    }

    /**
     * @return array[]
     */
    public function statisticsCPCDataProvider(): array
    {
        return [
            [StatisticsFixture::create(100, 50, 10), .2],
            [StatisticsFixture::create(100, 50, 0), 0],
            [StatisticsFixture::create(0, 0, 10), 0],
        ];
    }

    /**
     * @return array[]
     */
    public function statisticsCPMDataProvider(): array
    {
        return [
            [StatisticsFixture::create(100, 50, 10), .1],
            [StatisticsFixture::create(100, 50, 0), 0],
            [StatisticsFixture::create(0, 0, 10), 0],
        ];
    }

    public function testToArray()
    {
        $statistics = StatisticsFixture::createOnDate('2022-01-01', 100, 50, 10);
        $statisticsArray = $statistics->toArray();
        $keys = [
            'date', 'views', 'clicks', 'cost', 'cpc', 'cpm',
        ];
        foreach ($keys as $key) {
            $this->assertArrayHasKey($key, $statisticsArray);
        }
    }
}
