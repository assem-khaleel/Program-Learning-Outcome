<?php

namespace App\Mail;

use App\Models\Settings\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserPassword extends Mailable
{
    use Queueable, SerializesModels;


    public $user;
    /**
     * @var
     */
    private $password;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param $password
     */
    public function __construct(User $user,$password)
    {
        $this->user=$user;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user= $this->user->all();
        return $this->markdown('emails.userPassword.change')->with('user',$user)->with('password',$this->password);
    }
}
