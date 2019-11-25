<?php

namespace App\Notifications;

use App\CustomNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewMessage extends Notification
{
    use Queueable;
    var $reservation;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($reservation)
    {
        $this->reservation=$reservation;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }




    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        //anti pattern, ali ubacujem ih ovdje, gdje sve imam dostupno :/
        $custom=new CustomNotification();
        $custom->user_id=$notifiable->id;
        $custom->text='Your '.($this->reservation->listing->isMine()?"host":"guest").' has sent you a new message.';
        $custom->url=route(($this->reservation->listing->isMine()?"reservations.show":"guestlist.show"), ["id"=>$this->reservation->id]);
        $custom->save();

        return (new MailMessage)
                    ->line('Your '.($this->reservation->listing->isMine()?"host":"guest").' has sent you a new message.')
                    ->action('See message', route(($this->reservation->listing->isMine()?"reservations.show":"guestlist.show"), ["id"=>$this->reservation->id]))
            ->subject("Reservation #".$this->reservation->id. " | New chat message");
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
            //
        ];
    }
}
