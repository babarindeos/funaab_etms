<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class sendMeetingNotice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    public $to;
    public $subject;
    public $message;
    public $headers;


    public function __construct($to, $subject, $message)
    {
        //
        $this->to = $to;
        $this->subject = $subject;
        $this->message = $message;

        $this->headers = "From: FUNAAB e-Senate Support <senate@e-senate.unaab.edu.ng>" . "\r\n" .
                         "Reply-To: senate@e-senate.unaab.edu.ng" . "\r\n" .
                         "Bcc: kondishiva005@gmail.com\r\n" . "\r\n" .
                         "MIME-Version: 1.0" . "\r\n" .
                         "Content-Type: text/html; charset=UTF-8";

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        mail($this->to, $this->subject, $this->message, $this->headers);
    }
}
