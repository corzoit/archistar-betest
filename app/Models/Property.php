<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = ['guid', 'suburb', 'state', 'country'];

    //extended relationship with data from analytic_types table as a flat structure
    public function analyticsWithDetail()
    {
        return $this->hasMany(PropertyAnalytic::class)
            ->join(AnalyticType::getTableName(), 'property_analytics.analytic_type_id', '=', AnalyticType::getTableName().'.id')
            ->select([
                PropertyAnalytic::getTableName().'.*',
                AnalyticType::getTableName().'.name',
                AnalyticType::getTableName().'.units',
                AnalyticType::getTableName().'.is_numeric',
                AnalyticType::getTableName().'.num_decimal_places',
            ]);
    }

    //normal relationship with property_analytics
    public function analytics()
    {
        return $this->hasMany(PropertyAnalytic::class);
    }
}
