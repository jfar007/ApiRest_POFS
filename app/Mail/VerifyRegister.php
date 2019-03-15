<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;


class VerifyRegister extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public $user;
     public $register;


    public function __construct(User $user,  $register)
    {
        $this->user = $user;
        $this->register = $register;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('confirmation_code')
        ->with([
            'name' => $this->user->name,
            'username' => $this->user->username,
            'password' => $this->user->password,
            'confirmation_code' => $this->user->confirmation_code,
            'register' => $this->register            
        ]);

    }
}