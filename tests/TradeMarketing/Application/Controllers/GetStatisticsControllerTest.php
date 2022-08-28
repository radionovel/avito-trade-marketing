<?php
declare(strict_types=1);


namespace Tests\TradeMarketing\Application\Controllers;

use App\TradeMarketing\Domain\Repositories\StatisticsRepositoryInterface;
use Illuminate\Support\Collection;
use Mockery\MockInterface;
use Tests\TestCase;

class GetStatisticsControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->app->bind(StatisticsRepositoryInterface::class, function () {
            return \Mockery::mock(StatisticsRepositoryInterface::class, function (MockInterface $mock) {
                $mock->shouldReceive('paginate')
                    ->andReturn(Collection::empty())
                    ->once();
            });
        });
    }

    /**
     * @return void
     */
    public function testGetHandler(): void
    {
        $this->get('/api/v1/statistics');

        $this->assertResponseOk();
    }
}
