<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NoticeCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $notice;
    public $employee;

    public function __construct($notice, $employee)
    {
        $this->notice = $notice;
        $this->employee = $employee;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Notice: ' . $this->notice->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.notice-created',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
