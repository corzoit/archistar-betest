<?php

use Illuminate\Database\Seeder;

use App\Imports\AppImport;

class PropertyAnalyticsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $import = new AppImport();
        $import->onlySheets('Property_analytics');

        Excel::import($import, base_path(config('app.seederMasterFile')));
    }
}
