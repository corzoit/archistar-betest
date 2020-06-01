<?php

use Illuminate\Database\Seeder;

use App\Imports\AppImport;

class AnalyticTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $import = new AppImport();
        $import->onlySheets('AnalyticTypes');

        Excel::import($import, base_path(config('app.seederMasterFile')));
    }
}
