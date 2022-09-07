<?php
declare(strict_types=1);


namespace Tests\TradeMarketing\Infrastructure\Factories;

use App\TradeMarketing\Domain\Entities\Statistics;
use App\TradeMarketing\Infrastructure\Factories\StatisticsFactory;
use App\TradeMarketing\Infrastructure\Models\Statistics as Model;
use Carbon\CarbonImmutable;
use Tests\TestCase;
use Tests\TradeMarketing\Fixtures\MoneyFixture;

class StatisticsFactoryTest extends TestCase
{
    public function testCreateFromModel()
    {
        $date = CarbonImmutable::now()->startOfDay();
        $money = MoneyFixture::createRUB(100);
        $model = Model::create([
            'date' => $date,
            'views' => 100,
            'clicks' => 50,
            'cost' => 100.0,
        ]);

        $entity = StatisticsFactory::createFromModel($model);
        $this->assertInstanceOf(Statistics::class, $entity);
        $this->assertTrue($date->eq($entity->getDate()));
        $this->assertEquals(100, $entity->getViews());
        $this->assertEquals(50, $entity->getClicks());
        $this->assertTrue($money->equals($entity->getCost()));
    }

    public function testCreateFromArray()
    {
        $date = CarbonImmutable::now()->startOfDay();
        $money = MoneyFixture::createRUB(100);

        $entity = StatisticsFactory::createFromArray([
            'date' => $date,
            'views' => 100,
            'clicks' => 50,
            'cost' => 100.0,
        ]);

        $this->assertInstanceOf(Statistics::class, $entity);
        $this->assertTrue($date->eq($entity->getDate()));
        $this->assertEquals(100, $entity->getViews());
        $this->assertEquals(50, $entity->getClicks());
        $this->assertTrue($money->equals($entity->getCost()));
    }

    public function testCreateFromArrayStringDate()
    {
        $date = CarbonImmutable::now()->startOfDay();
        $entity = StatisticsFactory::createFromArray([
            'date' => $date->format('Y-m-d'),
            'views' => 100,
            'clicks' => 50,
            'cost' => 100.0,
        ]);

        $this->assertTrue($date->eq($entity->getDate()));
    }

    public function testCreateFromArrayWrongDateType()
    {
        $this->expectException(\InvalidArgumentException::class);

        StatisticsFactory::createFromArray([
            'date' => new \stdClass(),
            'views' => 100,
            'clicks' => 50,
            'cost' => 100.0,
        ]);
    }


}
