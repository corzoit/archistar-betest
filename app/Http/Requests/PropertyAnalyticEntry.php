<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\PropertyAnalytic;

class PropertyAnalyticEntry extends FormRequest
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
            'analytic_type_id' => 'required|exists:App\Models\AnalyticType,id',
            'value' => 'required|numeric',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            $analyticType = $validator->getData()['analytic_type_id'] ?? null;
            $propertyId = $validator->getData()['property_id'] ?? null;

            $propertyHasAnalytic = PropertyAnalytic
                ::wherePropertyId($propertyId)
                ->whereAnalyticTypeId($analyticType)
                ->exists();
            if($propertyHasAnalytic){
                $validator->errors()->add('analytic_type_id', 'This property already has assigned analytic type: '.$analyticType);
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
        ]);
    }
}
