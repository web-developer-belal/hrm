<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PayrollUpdate extends Mailable
{
    use Queueable, SerializesModels;
    
    public $payroll;
    /**
     * Create a new message instance.
     */
    public function __construct($payroll)
    {
        $this->payroll = $payroll;
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject:$this->payroll->employee->gender=='male'?'Mr. ':($this->payroll->employee->gender=='female'?'Ms. ':'').$this->payroll->employee->first_name.' Payroll Has Been Generated',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.payslip',
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
