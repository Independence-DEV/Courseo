<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewUser extends Mailable
{
    use Queueable, SerializesModels;

    private $name;
    private $website;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $website)
    {
        $this->name = $name;
        $this->website = $website;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('contact@courseo.tech', config('app.name'))
            ->subject('Welcome!')
            ->markdown('emails.newuser')
            ->with('name', $this->name)
            ->with('website', $this->website);
    }
}
