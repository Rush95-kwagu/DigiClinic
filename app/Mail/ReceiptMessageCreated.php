<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReceiptMessageCreated extends Mailable
{
    use Queueable, SerializesModels;

    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $subject;
    

    public function __construct($subject)
    {
        $this->subject = $subject;
      
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mailpay')
            ->from('izishopper1@gmail.com')
            ->subject($this->subject);
    }
}
