<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateCustomerPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $detail;

     public function __construct($detail)
    {
        $this->detail = $detail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // $email = env('mail_from_address',"contactus@equinomics.co.in");
        return $this->from("avni.sassyinfotech@gmail.com")->subject('Jobboosts')->markdown('frontend.emails.user-update-password-send')->with('data', $this->detail);
    }
}
