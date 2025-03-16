<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Verify Your Email')
            ->view('emails.verify-email')
            ->with([
                'verificationLink' => route('verify-email', ['token' => $this->user->email_verification_token])
            ]);
    }
}
