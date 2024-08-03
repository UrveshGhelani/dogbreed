<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\BreedController;

// Handler to fetch the data from 3rd party and store it into DB
// Kernel has been setup with scheduler to call the handler every 30 min


class UpdateBreeds extends Command
{
    
    protected $signature = 'breeds:update';
    protected $description = 'Update breeds from the external API every 30 MIN';

    public function handle()
    {
        $controller = new BreedController();
        $controller->getAllBreedsCronJob();
        $this->info('Breeds updated successfully');
    }
}