<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class Job
{
    public $title;
}

class JobPosted extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    
    public Job $new_job;

    public function __construct(public Job $job)
    {
        //
        //dd($job->title);
        $this->new_job = $job;
        dd($this->new_job);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Job Posted',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        //dd($job->title);

        return new Content(
            view: 'mail.job-posted',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
