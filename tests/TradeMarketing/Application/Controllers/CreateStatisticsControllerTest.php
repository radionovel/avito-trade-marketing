<?php
declare(strict_types=1);


namespace Tests\TradeMarketing\Application\Controllers;

use App\TradeMarketing\Domain\Repositories\StatisticsRepositoryInterface;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateStatisticsControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->app->bind(StatisticsRepositoryInterface::class, function () {
            return \Mockery::mock(StatisticsRepositoryInterface::class, function (MockInterface $mock) {
                $mock->shouldReceive('add')->once();
            });
        });
    }

    /**
     * @param $request
     * @return void
     *
     * @dataProvider invalidRequest
     */
    public function testCreateHandlerInvalid($request)
    {
        $this->post('/api/v1/statistics', $request);

        $this->assertResponseStatus(422);
    }

    public function invalidRequest()
    {
        return include __DIR__ . '/Fixtures/invalid_requests.php';
    }

    /**
     * @param $request
     * @return void
     *
     * @dataProvider validRequest
     */
    public function testCreateHandlerValid($request)
    {
        $this->post('/api/v1/statistics', $request);

        $this->response->assertCreated();
    }

    public function validRequest()
    {
        return include __DIR__ . '/Fixtures/valid_requests.php';
    }


}
