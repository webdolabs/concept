<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPaymentSend extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     */
     protected $email;

     /**
      * Create a new message instance.
      *
      * @return void
      */
     public function __construct($email)
     {
         $this->email = $email;
     }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.order-payment-send', ['email' => $this->email])
            ->from("noreply@petrolwear.cz", "PetrolWear")
            ->replyTo("info@petrolwear.cz", "PetrolWear")
            ->subject("Nezaplacená objednávka");
    }
}
