<?php

namespace App\Channels;

use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Notification;
use Twilio\Rest\Client;

class WhatsAppChannel
{
    public function send($notifiable, Notification $notification)
    {
        try {
            if ($notification->isActiveDriver($notifiable, 'sms')) {
                $message = $notification->toWhatsApp($notifiable);
                $to = $notifiable instanceof AnonymousNotifiable
                    ? $notifiable->routeNotificationFor('whatsapp')
                    : $notifiable->phone;
                $from = config('services.twilio.whatsapp_from');

                $twilio = new Client(config('services.twilio.sid'), config('services.twilio.token'));

                return $twilio->messages->create("whatsapp:$to", [
                    "from" => "whatsapp:$from",
                    "body" => $message->content
                ]);
            }
        } catch (\Exception $e) {
            dd("Error: " . $e->getMessage());
        }
    }
}
