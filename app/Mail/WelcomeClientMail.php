<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeClientMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public User $client)
    {
    }

    public function build()
    {
        return $this->subject('Welcome to ClientHub')
            ->view('emails.welcome-client');
    }
}