<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


class ImportCie10 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:cie10';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import the CIE10 database';

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
        DB::unprepared(file_get_contents('database/import/groupscie10.sql'));
        DB::unprepared(file_get_contents('database/import/subgroupscie10.sql'));
        DB::unprepared(file_get_contents('database/import/categoriescie10.sql'));
        DB::unprepared(file_get_contents('database/import/diagnosescie10.sql'));
    }
}
