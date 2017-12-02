<?php

namespace GitLab\Ripple\Commands;

use Illuminate\Console\Command;

class RippleImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ripple:images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'All images';

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
        $this->info('Publishing the Ripple assets/images files');
        $this->info('Moving Images files to Public Vendor...');
        $this->call('vendor:publish', ['--tag'=>'images', '--force'=>true]);
    }

    protected function getOptions()
    {
        return [
            ['with-dummy', null, 1, 'Install with dummy data', null],
        ];
    }
}
