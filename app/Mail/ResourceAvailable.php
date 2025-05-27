<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResourceAvailable extends Mailable
{
    use Queueable, SerializesModels;

    public mixed $resource;

    public mixed $user;
    /**
     * Create a new message instance.
     */
    public function __construct($resource, $user)
    {
        $this->resource = $resource;

        $this->user = $user;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Resource Available',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.resource-available',

            with: [

                "resource" => $this->resource,

                "first_name" => $this->user->first_name,

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