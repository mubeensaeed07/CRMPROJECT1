<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Supervisor;

class SupervisorRegisteredMail extends Mailable
{
    use Queueable, SerializesModels;

    public $supervisor;
    public $password;
    public $adminName;

    /**
     * Create a new message instance.
     */
    public function __construct(Supervisor $supervisor, $password, $adminName = null)
    {
        $this->supervisor = $supervisor;
        $this->password = $password;
        $this->adminName = $adminName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to CRM System - Your Supervisor Account Has Been Created',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.supervisor-registered',
            with: [
                'supervisor' => $this->supervisor,
                'password' => $this->password,
                'adminName' => $this->adminName,
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
