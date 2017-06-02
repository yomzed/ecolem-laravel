<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeEnvCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:env {envname : The name of the new environment}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a new environment file based on the example';

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
        if( copy( base_path('.env.example'), base_path('env/env.' . $this->argument('envname')) ) )
            $this->info('Environment file created successfully.');
        else
            $this->error('Unexpected error during the file creation');
    }
}
