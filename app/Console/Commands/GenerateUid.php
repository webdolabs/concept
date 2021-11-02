<?php

namespace App\Console\Commands;

use App\Traits\RecordHelper;
use Illuminate\Console\Command;

class GenerateUid extends Command
{
    use RecordHelper;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:uid';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Record ID in db structure';

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
        $this->info('New ID: <fg=red>' . $this->getUuid() . '</>');
        return 0;
    }
}
