<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailVerify extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $verification_code_send_user;

    public function __construct($verification_code_send_user)
    {
        //
        $this->verification_code_send_user = $verification_code_send_user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // $email = env('MAIL_USERNAME');
        return $this->from('avni.sassyinfotech@gmail.com')->subject('Jobboosts')->markdown('frontend.emails.email-verification')->with('data', $this->verification_code_send_user);
    }
}
