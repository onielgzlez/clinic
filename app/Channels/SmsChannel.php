<?php

namespace App\Channels;

use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Notification;
use Twilio\Rest\Client;

class SmsChannel
{
    public function send($notifiable, Notification $notification)
    {
        try {
            if ($notification->isActiveDriver($notifiable, 'sms')){
                $message = $notification->toSms($notifiable);
                $to = $notifiable instanceof AnonymousNotifiable
                    ? $notifiable->routeNotificationFor('sms')
                    : $notifiable->phone;
                $from = config('services.twilio.sms_from');
    
                $twilio = new Client(config('services.twilio.sid'), config('services.twilio.token'));
    
                return $twilio->messages->create($to, [
                    "messagingServiceSid" => $from,
                    "body" => $message->content
                ]);
            }            
        } catch (\Exception $e) {
            dd("Error: " . $e->getMessage());
        }
    }
}
