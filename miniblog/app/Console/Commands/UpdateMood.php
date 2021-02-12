<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Models\Post;
use App\Models\Mood_update;


class UpdateMood extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mood:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update mood value for posts';

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

        $join = DB::select("select post_id, sum(mood_weights.weight) as mood, status  from mood_updates  inner join mood_weights on mood_weights.id = mood_updates.mood_weight_id where status = 'pending' group by post_id");

        foreach ($join as $jo) {

        $post = Post::where('id', '=', $jo->post_id)->first();
        $post->mood = $post->mood + $jo->mood;
        $post->save();

        }

        $pending = DB::select("select mood_updates.id as id, post_id, mood_weights.weight as mood, status  from mood_updates  inner join mood_weights on mood_weights.id = mood_updates.mood_weight_id where status = 'pending'");

        foreach ($pending as $post) {

        $item = Mood_update::find($post->id);
        $item->status = 'procesed';
        $item->save();

        }

        $this->info('updated karma in news items');

    }
}
