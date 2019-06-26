<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewsletterContent extends Mailable
{
    use Queueable, SerializesModels;
    
    
    public $client;
    public $newsletter; 

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($client, $newsletter)
    {
        //
        $this->client = $client;
        $this->newsletter = $newsletter;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.newsletter');
    }
}
