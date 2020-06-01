<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\CanRespond;

use App\Service\SearchStatsService;
use App\Http\Requests\StatsSearch;

class StatsController extends Controller
{
    use CanRespond;

    protected $searchStatsService;

    public function __construct(
        SearchStatsService $searchStatsService){
        $this->searchStatsService = $searchStatsService;
    }

    public function search(StatsSearch $request){

        $results = $this->searchStatsService->make($request->all());
        return $this->respondWithSuccess($results);
    }

}
