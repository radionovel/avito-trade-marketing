<?php
declare(strict_types=1);


namespace Tests\TradeMarketing\Application\Controllers;

use App\TradeMarketing\Domain\Repositories\StatisticsRepositoryInterface;
use Mockery\MockInterface;
use Tests\TestCase;

class DeleteStatisticsControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->app->bind(StatisticsRepositoryInterface::class, function () {
            return \Mockery::mock(StatisticsRepositoryInterface::class, function (MockInterface $mock) {
                $mock->shouldReceive('clear')->once();
            });
        });
    }

    /**
     * @return void
     */
    public function testDeleteHandler()
    {
        $this->delete('/api/v1/statistics');

        $this->assertResponseOk();
    }
}
