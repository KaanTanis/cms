<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Artisan;

class Anka extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:anka';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new page';

    protected $type = 'Page';


    public function getStub()
    {
        return base_path() . '/stubs/anka.stub';
    }

    public function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Anka';
    }

    public function handle()
    {
        parent::handle();
        Artisan::call('make:model ' . $this->getNameInput() . ' -m');
    }

}
