<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\CanRespond;
use App\Service\CreatePropertyService;

class PropertyController extends Controller
{
    use CanRespond;

    protected $createPropertyService;

    public function __construct(CreatePropertyService $createPropertyService){
        $this->createPropertyService = $createPropertyService;
    }

    public function create(Request $request){

        $request->validate([
            'guid' => 'unique:App\Models\Property,guid',
            'suburb' => 'required|max:255',
            'state' => 'required|max:255',
            'country' => 'required|max:255',
        ]);

        $property = $this->createPropertyService->make($request->all());
        return $this->respondWithSuccess($property);
    }

}
