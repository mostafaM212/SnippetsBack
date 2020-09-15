<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class newUserMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $user ;
     protected $password ;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user ,$newPassword)
    {
        //
        $this->user = $user ;
        $this->password = $newPassword ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->user ;
        $password = $this->password ;
        return $this->markdown('emails.forget',compact(['user','password']));
    }
}
