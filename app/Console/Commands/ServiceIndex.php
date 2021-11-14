<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ServiceIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'service:index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all services from csv as array';

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
        $csv = array_map('str_getcsv', file(storage_path('app/services.csv')));

        $columns = $csv[0];
        array_shift($csv);
        $this->table($columns, $csv);

        return 0;
    }
}
