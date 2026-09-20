<?php

namespace App\Mail;

use App\Models\Milestone;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MilestoneCompletedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Milestone $milestone)
    {
    }

    public function build()
    {
        return $this->subject("Milestone Completed: {$this->milestone->title}")
            ->view('emails.milestone-completed');
    }
}
