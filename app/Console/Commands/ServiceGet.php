<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ServiceGet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'service:get {code}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get specific service from csv as array. checking by countryCode';

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

        $code = $this->argument('code');

        $services = [];
        foreach ($csv as $row) {
            if (strtolower($code) == strtolower($row[3])) {
                $services[] = $row;
            }
        }
        $this->table($columns, $services);

        return 0;
    }
}
