<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TrainingRequestConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $reference_no;

    public function __construct($user, $reference_no)
    {
        $this->user = $user;
        $this->reference_no = $reference_no;
    }

    public function build()
    {
        return $this->subject('Training Request Confirmation')
            ->view('emails.training_request_confirmation');
    }
}
