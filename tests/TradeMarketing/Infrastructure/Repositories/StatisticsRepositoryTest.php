<?php
declare(strict_types=1);


namespace Tests\TradeMarketing\Infrastructure\Repositories;

use App\TradeMarketing\Infrastructure\Filters\StatisticsQueryFilter;
use App\TradeMarketing\Infrastructure\Models\Statistics as Model;
use App\TradeMarketing\Infrastructure\Repositories\StatisticsRepository;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Tests\TestCase;
use Tests\TradeMarketing\Fixtures\StatisticsFixture;

class StatisticsRepositoryTest extends TestCase
{
    public function testClear()
    {
        Model::query()->truncate();
        Model::create([
            'date' => CarbonImmutable::now(),
            'views' => 0,
            'clicks' => 0,
            'cost' => 0,
        ]);

        $repository = new StatisticsRepository();
        $repository->clear();

        $this->assertEquals(0, Model::query()->count());
    }

    public function testAdd()
    {
        $date = CarbonImmutable::now();
        $entity = StatisticsFixture::createOnDate(
            $date->format('Y-m-d'),
            100,
            50,
            80
        );
        $repository = new StatisticsRepository();
        $repository->add($entity);

        $this->seeInDatabase('statistics', [
            'date' => $date->format('Y-m-d'),
            'views' => 100,
            'clicks' => 50,
            'cost' => 80.0,
        ]);
    }

    public function testPaginate()
    {
        Model::query()->truncate();
        Model::create([
            'date' => CarbonImmutable::now(),
            'views' => 0,
            'clicks' => 0,
            'cost' => 0,
        ]);

        $request = new Request();
        $filter = new StatisticsQueryFilter($request);

        $repository = new StatisticsRepository();
        $paginate = $repository->paginate($filter);

        $this->assertArrayHasKey('data', $paginate->toArray());
        $this->assertArrayHasKey('current_page', $paginate->toArray());
        $this->assertArrayHasKey('from', $paginate->toArray());
        $this->assertArrayHasKey('last_page', $paginate->toArray());
        $this->assertArrayHasKey('links', $paginate->toArray());
    }
}
