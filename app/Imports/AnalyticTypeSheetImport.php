<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\AnalyticType;

class AnalyticTypeSheetImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // id	name	units	is_numeric	num_decimal_places
        return new AnalyticType([
            'id' => $row[0],
            'name' => $row[1],
            'units' => $row[2],
            'is_numeric' => $row[3],
            'num_decimal_places' => $row[4]
        ]);
    }
}