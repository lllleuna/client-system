<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\VonageMessage;

class SendOtpNotification extends Notification
{
    use Queueable;

    protected $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function via($notifiable)
    {
        return ['vonage'];
    }

    public function toVonage($notifiable)
    {
        return (new VonageMessage)
            ->content("Your OTP code is: {$this->otp}")
            ->from(config('services.vonage.sms_from'));
    }

    public function toArray($notifiable)
    {
        return [
            'otp' => $this->otp,
        ];
    }
}

