<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class OrderStatusChanged extends Mailable {
    use Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order) {
        $this->order = $order;
    }

    public function build() {
        return $this->subject('Your Order Status has been Updated')
                    ->markdown('email.status')
                    ->with([
                        'order' => $this->order,
                    ]);
    }    
}
