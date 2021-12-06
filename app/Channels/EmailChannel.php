<?php

namespace App\Channels;

use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;

class EmailChannel
{
    public function send($notifiable, Notification $notification)
    {
        try {
            if ($notification->isActiveDriver($notifiable, 'mymail')){
                $message = $notification->toEmail($notifiable);      
                $address = $notifiable instanceof AnonymousNotifiable
                ? $notifiable->routeNotificationFor('email')
                : $notifiable->email;          
                Mail::to([$address])->send($message);
            }            
        } catch (\Exception $e) {
            dd("Error: " . $e->getMessage());
        }
    }
}
