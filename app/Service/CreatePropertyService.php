<?php

namespace App\Service;

use App\Models\Property;

class CreatePropertyService {

    public function make(Array $propertyData)
    {
        return Property::create([
            'guid' => $propertyData['guid'] ?? null,
            'suburb' => $propertyData['suburb'],
            'state' => $propertyData['state'],
            'country' => $propertyData['country']
        ]);
    }
}