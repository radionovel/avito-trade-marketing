<?php

namespace App\TradeMarketing\Application\Controllers;


use App\TradeMarketing\Application\Requests\GetStatisticsRequest;
use App\TradeMarketing\Domain\Repositories\StatisticsRepositoryInterface;
use App\TradeMarketing\Infrastructure\Filters\StatisticsQueryFilter;
use Illuminate\Http\JsonResponse;
use Laravel\Lumen\Routing\Controller;

class GetStatisticsController extends Controller
{
    /**
     * @param GetStatisticsRequest $request
     * @param StatisticsRepositoryInterface $repository
     * @return JsonResponse
     */
    public function __invoke(GetStatisticsRequest $request, StatisticsRepositoryInterface $repository): JsonResponse
    {
        $data = $repository->paginate(
            new StatisticsQueryFilter($request->request())
        );
        return response()->json($data->toArray());
    }
}
