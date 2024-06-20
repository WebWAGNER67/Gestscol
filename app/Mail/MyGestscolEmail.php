<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MyGestscolEmail extends Mailable
{
    use Queueable, SerializesModels;

    private string $nom;
    private string $prenom;
    private string $promo;
    private string $parcours;
    private string $group;
    private string $password;

    /**
     * Create a new message instance.
     */
    public function __construct($nom, $prenom,$promo, $parcours, $group, $password)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->promo = $promo;
        $this->parcours = $parcours;
        $this->group = $group;
        $this->password = $password;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'My Gestscol Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.test-email',
            with: [
                'nom' => $this->nom,
                'prenom' => $this->prenom,
                'promo' => $this->promo,
                'parcours' => $this->parcours,
                'group' => $this->group,
                'password' => $this->password
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