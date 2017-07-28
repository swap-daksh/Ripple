<?php

namespace ETU\Ripple\Commands;

use Illuminate\Console\Command;

class RippleCssJs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ripple:css-js';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Main js and css files';

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

        $this->info('Moving Ripple Css files to Public Vendor...');
        $this->call('vendor:publish', ['--tag'=>'css', '--force'=>true]);
        $this->info('Moving Ripple Js files to Public Vendor...');
        $this->call('vendor:publish', ['--tag'=>'js', '--force'=>true]);
    }

    protected function getOptions() {
        return [
            ['with-dummy', null, 1, 'Install with dummy data', null],
        ];
    }
}
