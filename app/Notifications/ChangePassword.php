<?php

namespace App\Notifications;

use App\Models\Settings\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ChangePassword extends Notification
{
    use Queueable;


    public $user;
    /**
     * @var
     */
    private $password;

    /**
     * Create a new notification instance.
     *
     * @param User $user
     * @param $password
     */
    public function __construct(User $user,$password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Your account has been created ')

                    ->line('Please find your credentials :')
                    ->line( 'your email is :'.$this->user->email)
                    ->line( 'your password is :'.$this->password)
                    ->action('You can change your password here', url('login'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'name'=>$this->user->name,
            'password'=>$this->password,
            'email'=> $this->user->email,

        ];
    }
    public function toArray($notifiable)
    {
        return [
            'name'=>$this->user->name,
            'password'=>$this->password,
            'email'=> $this->user->email,

        ];
    }
}
