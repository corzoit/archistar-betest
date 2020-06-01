<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Excel;

class CsvSeedGeneratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'util:seed-xlsx-to-csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Converts Excel seeder file into separate CSV files';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        dd(\Excel);
    }
}
