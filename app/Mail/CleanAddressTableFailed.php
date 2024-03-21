<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;

/**
 * Clean address table failed.
 * Send an e-mail to a destination address.
 * 
 * @class CleanAddressTableFailed
 * @package App\Mail
 */
class CleanAddressTableFailed extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public string $messages
    ) {
    }

    /** 
     * Get the message envelope.
     * 
     * @return Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(env('MAIL_JOB_SENDER'), env('APP_NAME')),
            subject: __('messages.emails.clean_address_table_failed.subject')
        );
    }

    /**
     * Get the message content definition.
     * 
     * @return Content
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.clean_address_table_failed',
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
