<?php

namespace YPC\Ripple\Commands;

use Illuminate\Console\Command;

class RippleDataType extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ripple:create-datatype {class :  Name Of Data Type i.e. VARCHAR}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate New Datatype for doctorine dbal 2 ORM';

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
        $option = $this->argument('class');
        $Class = $this->stub();
        foreach ($this->generateData($option) as $search => $replace):
            $Class = str_replace($search, $replace, $Class);
        endforeach;
        if (realpath($this->whereToWrite($option))):
            $this->info('Data Type is already exists');
        else:
            if (file_put_contents($this->whereToWrite($option), $Class)):
                $this->info('Data Type successfully created');
            endif;
        endif;
    }

    protected function stub()
    {
        return file_get_contents(realpath(__DIR__ . '/../Support/Stubs/DataType.php'));
    }

    protected function generateData($option)
    {
        return ["CONSTANT" => strtoupper($option), "CONST_VALUE" => strtolower($option), "TypeClass" => $this->className($option)];
    }

    protected function className($class)
    {
        if (ctype_upper($class)):
            return ucfirst(strtolower($class));
        else:
            return ucfirst($class);
        endif;
    }

    protected function whereToWrite($filename)
    {
        $DIR = __DIR__ . '/../Support/Database/DataTypes/Types/';
        $FILE = $this->className($filename);
        $EXT = '.php';
        return ($DIR . $FILE . $EXT);
    }

}
