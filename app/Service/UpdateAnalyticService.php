<?php

namespace App\Service;

use App\Models\PropertyAnalytic;

class UpdateAnalyticService {

    public function make(Array $paData)
    {
        $success =  PropertyAnalytic
            ::where('id', $paData['analytic_id'])
            ->update([
                'value' => $paData['value'],
            ]);
        return $success ? PropertyAnalytic::find($paData['analytic_id']):null;
    }
}