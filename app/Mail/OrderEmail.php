<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;

    public function __construct($mailData) {
        $this->mailData = $mailData;
    }

    public function build() {
        $subject = $this->mailData['userType'] === 'customer'
            ? 'Thank You for Your Order! Keep shopping'
            : 'New Order Received';

        return $this->view('email.order')
                    ->subject($subject)
                    ->with(['mailData' => $this->mailData]);
    }

}
