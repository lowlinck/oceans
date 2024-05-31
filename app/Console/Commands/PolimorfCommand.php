<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Console\Command;

class PolimorfCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'poli';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
//        $post = Post::find(1);
//        $comment = Comment::find(3);
//        $profile = Profile::find(1);
        $category = Category::find(3);

//        dd($comment->likes);
//        dd($comment->category);
        dd($category->comments);

//         dd($post->likes);
//         dd($profile->images->pluck('url'));
//         dd($category->images->pluck('url'));
//         dd($category->images->pluck('url'));

    }
}
