<?php

namespace App\Service;

use DB;

class SearchStatsService {

    public function make(Array $params)
    {
        $response = [];

        //getting all possible anlytic types for subject (search)
        $analyticTypesForSubject = DB::select('
            SELECT DISTINCT pa.analytic_type_id, at.name
            FROM properties AS p
                JOIN property_analytics AS pa ON p.id = pa.property_id
                JOIN analytic_types AS at ON pa.analytic_type_id = at.id
            WHERE '.$params['key'].' like :value', ['value' => $params['value']]);

        foreach($analyticTypesForSubject as $analyticType){
            $statsValues = DB::table('property_analytics')
                        ->join('properties', 'property_analytics.property_id', '=', 'properties.id')
                        ->where('properties.'.$params['key'], $params['value'])
                        ->where('property_analytics.analytic_type_id', $analyticType->analytic_type_id)
                        ->orderBy('property_analytics.value', 'asc')
                        ->pluck('value')
                        ->toArray();

            $statsNotNullValues = array_filter($statsValues, function($item){
                return !is_null($item);
            });

            $numStatsV = count($statsValues);
            $numStatsNNV = count($statsNotNullValues);
            $withValues = ($numStatsNNV / $numStatsV * 100);

            $stats = [
                'min' => min($statsNotNullValues) * 1,
                'max' => max($statsNotNullValues) * 1,
                'median' => $numStatsNNV % 2 === 0
                    ? ($statsNotNullValues[$numStatsNNV/2] + $statsNotNullValues[($numStatsNNV/2) - 1]) / 2
                    : $statsNotNullValues[floor($numStatsNNV/2)] * 1,
                'withValues' => $withValues.'%',
                'withoutValues' => (100 - $withValues).'%',
                'debug' => [
                    'numValues' => $numStatsV,
                    'data' => $statsValues
                ],
            ];

            array_push($response, [
                'id' => $analyticType->analytic_type_id,
                'name' => $analyticType->name,
                'stats' => $stats,
            ]);
        }

        return [
            'input' => $params,
            'response' => $response
        ];
    }
}