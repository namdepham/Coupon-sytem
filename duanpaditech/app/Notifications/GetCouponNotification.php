<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;

class GetCouponNotification extends Notification
{
    use Queueable, Notifiable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['nexmo'];
    }

    public function toNexmo($notifiable): NexmoMessage
    {
        return (new NexmoMessage)->content('You got an new coupon');
    }


    /**
     * @param $notification
     * @return mixed
     */
    public function routeNotificationForNexmo($notification)
    {
        return $this->phonenumber;
    }
}
