<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\CanRespond;

use App\Service\CreateAnalyticService;
use App\Service\UpdateAnalyticService;

use App\Http\Requests\PropertyAnalyticEntry;
use App\Http\Requests\PropertyAnalyticUpdate;
use App\Http\Requests\PropertyAnalyticSearch;

use App\Models\Property;

class AnalyticController extends Controller
{
    use CanRespond;

    protected $createAnalyticService;
    protected $updateAnalyticService;

    public function __construct(
        CreateAnalyticService $createAnalyticService,
        UpdateAnalyticService $updateAnalyticService){
        $this->createAnalyticService = $createAnalyticService;
        $this->updateAnalyticService = $updateAnalyticService;
    }

    public function create(String $property_id, PropertyAnalyticEntry $request){

        $property = $this->createAnalyticService->make(['property_id' => $property_id] + $request->all());
        return $this->respondWithSuccess($property);
    }

    public function update(String $property_id, String $analytic_id, PropertyAnalyticUpdate $request){
        $property = $this->updateAnalyticService->make(['analytic_id' => $analytic_id] + $request->all());
        return $this->respondWithSuccess($property);
    }

    // TODO: implement search filters (hence using form validator for search input)
    public function search(String $property_id, PropertyAnalyticSearch $request){
        return $this->respondWithSuccess(Property::find($property_id)->analyticsWithDetail);
    }

}
