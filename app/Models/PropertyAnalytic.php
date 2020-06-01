<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyAnalytic extends BaseModel
{
    protected $fillable = ['property_id', 'analytic_type_id', 'value'];
}
