<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ResetDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resets database.';

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
     * @return int
     */
    public function handle()
    {
        Artisan::call('migrate:fresh --seed');
        $this->info('Database was remigrated successfully.');
        Artisan::call('passport:install');
        $this->info('Passport was installed successfully.');
        return 0;
    }
}
