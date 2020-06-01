<?php

namespace App\Service;

use App\Models\PropertyAnalytic;

class CreateAnalyticService {

    public function make(Array $paData)
    {
        return PropertyAnalytic::create([
            'property_id' => $paData['property_id'],
            'analytic_type_id' => $paData['analytic_type_id'],
            'value' => $paData['value'],
        ]);
    }
}