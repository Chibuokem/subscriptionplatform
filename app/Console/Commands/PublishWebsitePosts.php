<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use App\Models\Website;
use App\Models\Subscription;
use Illuminate\Support\Facades\Mail;
use App\Mail\PublishPost;
use Carbon\Carbon;

class PublishWebsitePosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'publish:online-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish posts to subscribers online';

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
        //get unpublished posts
        $posts = Post::with('website')->where('published_to_subscribers', 0)->get();
        //loop through posts and send across to subscribers
        foreach($posts as $post){
            //get their subscribers
            $website_id = $post->website->id;
            $subsribers = Subscription::where('website_id', $website_id)->get();
            //confirm that this isnt a duplicate post
            $post_check = Post::where('title', $post->title)
                        ->where('description', $post->description)
                        ->where('website_id', $post->website->id)
                        ->where('published_to_subscribers', 1)
                        ->first();
            if(!$post_check){
                //this isnt a duplicate
                foreach ($subsribers as $subscriber){
                    //queue email sending to the user
                    $website = $post->website;
                    Mail::to($subscriber->email)->queue(new PublishPost($subscriber, $website, $post));
                }
                //update post
                $post->published_to_subscribers = 1;
                $post->published_to_subscribers_at = Carbon::now();
                $post->save();
            }else{
                //it is a duplicate update post, update as publised
                $post->published_to_subscribers = 1;
                $post->published_to_subscribers_at = Carbon::now();
                $post->save();
            }

        }


    }
}
