<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\PropertyAnalytic;

class PropertyAnalyticUpdate extends FormRequest
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
            'analytic_id' => 'required|exists:App\Models\PropertyAnalytic,id',
            'value' => 'required|numeric',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            $analyticId = $validator->getData()['analytic_id'] ?? null;
            $propertyId = $validator->getData()['property_id'] ?? null;

            $propertyHasAnalytic = PropertyAnalytic
                ::whereId($analyticId)
                ->wherePropertyId($propertyId)
                ->exists();
            if(!$propertyHasAnalytic){
                $validator->errors()->add('analytic_id', 'This analytic/property ids provided are invalid');
            }
        });
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
            'analytic_id' => request()->route('analytic_id'),
        ]);
    }
}
