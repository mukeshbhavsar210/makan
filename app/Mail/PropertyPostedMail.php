<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Property;

class PropertyPostedMail extends Mailable {
    use Queueable, SerializesModels;

    public $property;

    public function __construct($property){
        $this->property = $property;
    }

    public function build() {
        return $this->subject('Your property has been posted successfully')
                ->view('email.property_posted'); 
    }
    
    public function envelope(): Envelope {
        return new Envelope(
            subject: 'Property Posted Mail',
        );
    }

    public function content(): Content {
        return new Content(
            view: 'view.name',
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
