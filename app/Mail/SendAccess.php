<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendAccess extends Mailable
{
    use Queueable, SerializesModels;

    private $prospect;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($prospect)
    {
        $this->prospect = $prospect;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('hello@courseo.tech', 'Courseo')
            ->subject('Courseo is ready!')
            ->markdown('emails.sendaccess')
            ->with('prospect', $this->prospect);
    }
}
