<?php

namespace App\TradeMarketing\Application\Controllers;

use App\TradeMarketing\Domain\Repositories\StatisticsRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Laravel\Lumen\Routing\Controller;

class DeleteStatisticsController extends Controller
{
    /**
     * @param StatisticsRepositoryInterface $repository
     * @return JsonResponse
     */
    public function __invoke(StatisticsRepositoryInterface $repository): JsonResponse
    {
        $repository->clear();
        return response()->json([]);
    }
}
