<?php

namespace App\Notifications;

use App\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\CustomNotification;
class ReservationCanceled extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    var $reservation;
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
        $custom->text='Your guest has has canceled the reservation #'.$this->reservation->id;
        $custom->url=route('guestlist.show',["id"=>$this->reservation->id]);
        $custom->save();



        return (new MailMessage)
            ->line('Your guest has has canceled #'.$this->reservation->id)
            ->action('View reservation', route('guestlist.show',["id"=>$this->reservation->id]))
            ->subject("Reservation #".$this->reservation->id." | Reservation was canceled");

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
