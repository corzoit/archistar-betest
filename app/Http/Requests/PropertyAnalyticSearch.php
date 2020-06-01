<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\PropertyAnalytic;

class PropertyAnalyticSearch extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'property_id' => 'required|exists:App\Models\Property,id',
        ];
    }

    /**
     * Add parameters to be validated
     *
     * @return array
     */
    public function validationData()
    {
        //injecting property_id from route parameters to validation data
        return array_merge(request()->all(), [
            'property_id' => request()->route('property_id'),
        ]);
    }
}
