<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ApplicationClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to performe Cache, Config, Route and View clear';

    protected $commands = ['cache:clear', 'view:clear', 'route:clear', 'config:clear'];

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
        $this->info('----- // Starting \\\\ -----');

        $commands = $this->commands;

        foreach ($commands as $command) {
            $this->call($command);
        }

        $this->info('----- // Finished! \\\\ -----');
    }
}
