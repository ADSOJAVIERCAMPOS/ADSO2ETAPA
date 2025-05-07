<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     * @param array $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    { 
        return $this->view('emails.confirmed_call')
                    ->with('data', $this->data)
                    ->subject('¡Preinscripción Exitosa!');
    }
}