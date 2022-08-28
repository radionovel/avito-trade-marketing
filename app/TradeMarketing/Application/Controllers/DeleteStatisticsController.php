<?php

namespace App\TradeMarketing\Application\Controllers;

use App\TradeMarketing\Domain\Repositories\StatisticsRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Laravel\Lumen\Routing\Controller;

class DeleteStatisticsController extends Controller
{
    public function __invoke(StatisticsRepositoryInterface $repository): JsonResponse
    {
        $repository->clear();
        return response()->json([]);
    }
}
