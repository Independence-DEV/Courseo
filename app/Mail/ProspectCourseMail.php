<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProspectCourseMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;
    private $url;
    private $course;
    private $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($url, $course, $name)
    {
        $this->url = $url;
        $this->course = $course;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('hello@courseo.tech', $this->course->account->name)
            ->replyTo($this->course->account->config->email_from, $this->course->account->name)
            ->subject('Course access : '.$this->course->title)
            ->markdown('emails.prospectcourse')
            ->with('url', $this->url)
            ->with('course', $this->course)
            ->with('name', $this->name);
    }
}
