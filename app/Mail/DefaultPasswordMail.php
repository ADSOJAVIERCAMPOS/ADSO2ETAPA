<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DefaultPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $password;

    /**
     * Create a new message instance.
     */
    public function __construct($password)
    {
        $this->password = $password;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->view('emails.defaultPassword')
                    ->subject('Tu contraseña predeterminada')
                    ->with([
                        'password' => $this->password,
                    ]);
    }
}
