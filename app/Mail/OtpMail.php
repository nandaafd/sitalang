<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use PragmaRX\Google2FA\Exceptions\Contracts\Google2FA;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $google2fa;
    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        // $this->google2fa = $google2fa;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Otp Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // $otp = $this->google2fa->generateSecretKey();
        return new Content(
            view: 'auth.otpmail',
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
