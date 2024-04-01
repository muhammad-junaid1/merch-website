<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

     public $username;
     public $phoneNo; 
     public $companyEmail; 
     public $company; 
    public $message;

    /**
     * Create a new message instance.
     */
    public function __construct($username, $message, $phoneNo, $companyEmail, $company)
    {
         $this->username = $username;
        $this->message = $message;
        $this->phoneNo = $phoneNo; 
        $this->companyEmail = $companyEmail; 
        $this->company = $company; 

    }


       public function build()
    {
        return $this->subject('Message from User')
                    ->view('Mail')
                    ->with([
                        'username' => $this->username,
                        'messages' => $this->message,
                        'phone' => $this->phoneNo, 
                        'companyEmail' => $this->companyEmail, 
                        'company' => $this->company
                    ]);
    }

}
