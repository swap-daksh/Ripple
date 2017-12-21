<?php

namespace YPC\Ripple\Commands;

use Illuminate\Console\Command;

class RippleInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ripple:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is ripple install command';

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
        $this->info('Publishing the Ripple assets, database, and config files');

        $this->info('Moving Ripple Assets to Public Vendor...');
        $this->call('vendor:publish', ['--tag'=>'assets', '--force'=>true]);
        $this->info('Moving Config files...');
        $this->call('vendor:publish', ['--tag'=>'config', '--force'=>true]);
        $this->info('Moving Database migrations...');
        $this->call('vendor:publish', ['--tag'=>'database', '--force'=>true]);
    }

    protected function getOptions()
    {
        return [
            ['with-dummy', null, 1, 'Install with dummy data', null],
        ];
    }
}
