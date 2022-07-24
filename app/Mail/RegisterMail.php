<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email_confirmation_token,$name,$email)
    {
        $this->url = route('register.confirmation',$email_confirmation_token);
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->email)  // 送信先アドレス
        ->subject("ようこそ". $this->name ."さん")                 // 件名
        ->view('email.register')                            // 本文
        ->with(['url' => $this->url,'name' => $this->name]);                   // 本文に送る値
    }
}
