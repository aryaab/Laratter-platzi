<?php

namespace App\Notifications;

use App\User;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
// use App\Notifications\BroadcastMessage;

class UserFollowed extends Notification
{
    use Queueable;

    public $user;

    public $follower;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $follower)
    {
        // $this->user = $user;
        $this->follower = $follower;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Tienes un nuevo seguidor')
                    ->greeting('Hola, '.$notifiable->name)
                    ->line('El usuario @'. $this->follower->name .' te ha seguido.')
                    ->action('Ver perfil', url('/'.$this->follower->name))
                    // ->line('Thank you for using our application!');
                    ->salutation('Gracias por usar Laratter!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'follower' => $this->follower,
        ];
    }

    public function toBroadcast($notifiable) 
    {
        return new BroadcastMessage([
            'data' => $this->toArray($notifiable),

        ]);
        
    }
}
