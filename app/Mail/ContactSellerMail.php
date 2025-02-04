<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactSellerMail extends Mailable
{
    use SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @param  array  $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('رسالة جديدة عن سيارتك')
            ->view('emails.contact-seller')
            ->with('data', $this->data);
    }
}
