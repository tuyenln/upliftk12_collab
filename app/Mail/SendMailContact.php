<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailContact extends Mailable
{
    // use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Order
     */
    public $params;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($params)
    {
        $this->params = (object) $params;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd($this->params);
        $subject = "New contact from ".$this->params->title." ".$this->params->name." via UpLiftK12";
        return $this->subject($subject)
                    ->view('emails.contact')
                    ->with(['data' => $this->params]);
    }
}