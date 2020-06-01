<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Property;

class StatsSearch extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'key' => 'required|in:suburb,state,country',
            'value' => 'required',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            $key = $validator->getData()['key'] ?? null;
            $value = $validator->getData()['value'] ?? null;

            $hasPropertyMatch = Property
                ::where($key, '=', $value)
                ->exists();
            if(!$hasPropertyMatch){
                $validator->errors()->add('key', 'No analytics found for '.$key.': '.$value);
            }
        });
    }
}
