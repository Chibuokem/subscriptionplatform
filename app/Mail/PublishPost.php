<?php

namespace App\Mail;

use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PublishPost extends Mailable
{
    use Queueable, SerializesModels;

    public $post;
    public $subscription;
    public $website;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Subscription $subscription, $website, $post)
    {
        $this->subscription = $subscription;
        $this->post = $post;
        $this->website = $website;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.publish-post')
            ->subject('New Post')
            ->with([
                'subscription' => $this->subscription,
                'post' => $this->post,
                'website' => $this->website
            ]);
    }

}
