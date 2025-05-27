<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ScholarshipAllocated extends Mailable
{
    use Queueable, SerializesModels;

    public $receiver;
    public $scholar;

    /**
     * Create a new message instance.
     */
    public function __construct($receiver, $scholar)
    {
        $this->receiver = $receiver;
        $this->scholar = $scholar;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Scholarship Allocated',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.allocated-scholarship',

            with: [
                'first_name' => $this->receiver->first_name,
                'scholar' => $this->scholar,
                "level" => "success"
            ]
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