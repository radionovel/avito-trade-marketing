<?php
declare(strict_types=1);


namespace Tests\TradeMarketing\Infrastructure\Models;

use App\TradeMarketing\Domain\Entities\Statistics;
use App\TradeMarketing\Infrastructure\ModelQueryBuilders\StatisticsQueryBuilder;
use App\TradeMarketing\Infrastructure\Models\Statistics as Model;
use Carbon\CarbonImmutable;
use Tests\TestCase;
use Tests\TradeMarketing\Fixtures\MoneyFixture;

class StatisticsTest extends TestCase
{

    public function testToEntity()
    {
        $model = Model::create([
            'date' => CarbonImmutable::now(),
            'views' => 100,
            'clicks' => 50,
            'cost' => 100.0,
        ]);

        $this->assertInstanceOf(Statistics::class, $model->toEntity());
    }

    public function testQueryInstance()
    {
        $this->assertInstanceOf(StatisticsQueryBuilder::class, Model::query());
    }

    public function testCreateFromEntity()
    {
        Model::query()->truncate();
        $date = CarbonImmutable::now();

        $entity = new Statistics(
            $date,
            100,
            50,
            MoneyFixture::createRUB(100)
        );

        Model::createFromEntity($entity);

        $this->seeInDatabase('statistics', [
            'date' => $date->format('Y-m-d'),
            'views' => 100,
            'clicks' => 50,
            'cost' => 100.0,
        ]);
    }
}
