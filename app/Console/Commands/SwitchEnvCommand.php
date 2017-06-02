<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SwitchEnvCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'env:switch {envfile? : The name of the environement file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Switch into the specified environment file';

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
        $this->info('Changes the current environement');

        if($this->argument('envfile'))
            $env_file = $this->argument('envfile');
        else {
            $env_file = $this->ask('Specify the name of the environement you want to set');
        }

        if( file_exists( base_path('env/env.' . $env_file) ) )
        {
            $this->line('Copy of env/env.'.$env_file.'...');

            if( copy( base_path('env/env.' . $env_file), base_path('.env') ) )
            {
                $this->call('config:clear');
                $this->info('Environment successfully changed to ' . $env_file);
            }
            else
            {
                $this->error('Unexpected error during the copy');
            }
        }
        else
        {
            $this->error('Unknown file env.' . $env_file);
        }
    }
}
