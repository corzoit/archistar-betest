<?php

namespace App\Imports;

use App\Models\Property;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;

class AppImport implements WithMultipleSheets
{
    use WithConditionalSheets;

    public function conditionalSheets(): array
    {
        return [
            'Properties' => new PropertySheetImport(),
            'AnalyticTypes' => new AnalyticTypeSheetImport(),
            'Property_analytics' => new PropertyAnalyticSheetImport(),
        ];
    }

}
