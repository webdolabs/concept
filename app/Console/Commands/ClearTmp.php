<?php

namespace App\Console\Commands;

use App\Models\Post;
use Carbon\Carbon;

use Illuminate\Console\Command;

class ClearTmp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:tmp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $posts = Post::where('status', 'tmp')->where('created_at', '<=', Carbon::now()->subDays(0)->toDateTimeString())->get();
        
        foreach($posts as $post) {
            $post->delete();
        }
        //Post::where('status', 'tmp')
            // ->where('created_at', '<=', Carbon::now()->subDays(1)->toDateTimeString())
            // ->delete();
    }
}
