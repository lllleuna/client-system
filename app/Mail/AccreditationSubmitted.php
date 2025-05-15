<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccreditationSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $tcName;
    public $referenceNumber;

    /**
     * Create a new message instance.
     */
    public function __construct($tcName, $referenceNumber)
    {
        $this->tcName = $tcName;
        $this->referenceNumber = $referenceNumber;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Your Accreditation Reference Number')
            ->view('emails.accreditation_submitted');
    }
}
