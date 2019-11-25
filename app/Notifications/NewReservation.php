<?php

namespace App\Notifications;

use App\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\CustomNotification;
class NewReservation extends Notification
{
    use Queueable;

    var $reservation;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Reservation $reservation)
    {
        //
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
        $custom->text='You have recieved a new reservation for your listing "'.$this->reservation->listing->name.'".';
        $custom->url=route('guestlist.show', ["id"=>$this->reservation->id]);
        $custom->save();



        return (new MailMessage)
                    ->line('You have recieved a new reservation for your listing "'.$this->reservation->listing->name.'".')
                    ->action('View reservation', route('guestlist.show', ["id"=>$this->reservation->id]))->subject("BnB | New reservation");

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
