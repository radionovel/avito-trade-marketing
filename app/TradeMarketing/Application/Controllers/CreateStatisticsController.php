<?php

namespace App\TradeMarketing\Application\Controllers;


use App\TradeMarketing\Application\Requests\CreateStatisticsRequest;
use App\TradeMarketing\Domain\Repositories\StatisticsRepositoryInterface;
use App\TradeMarketing\Infrastructure\Factories\StatisticsFactory;
use Illuminate\Http\JsonResponse;
use Laravel\Lumen\Routing\Controller;

class CreateStatisticsController extends Controller
{
    public function __invoke(CreateStatisticsRequest $request, StatisticsRepositoryInterface $repository): JsonResponse
    {
        $statistics = StatisticsFactory::createFromArray($request->request()->all());
        $repository->add($statistics);

        return response()->json([], 201);
    }
}
