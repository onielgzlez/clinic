<?php

namespace App\Notifications;

use App\Channels\EmailChannel;
use App\Channels\Messages\SmsMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Channels\WhatsAppChannel;
use App\Channels\SmsChannel;
use App\Channels\Messages\WhatsAppMessage;
use App\Mail\AppointmentCreated;
use Illuminate\Notifications\AnonymousNotifiable;


class UserNotification extends Notification
{
    use Queueable;

    protected $appointment;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', EmailChannel::class, WhatsAppChannel::class, SmsChannel::class];
    }

    public function isActiveDriver($notifiable, $driver)
    {
        return ($notifiable instanceof AnonymousNotifiable && isset($notifiable->routes[$driver])) ? true : !($notifiable instanceof AnonymousNotifiable) && in_array($driver, $this->via($notifiable));
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if ($this->isActiveDriver($notifiable, 'mail')) {
            $address = $notifiable instanceof AnonymousNotifiable
                ? $notifiable->routeNotificationFor('mail')
                : $notifiable->email;

            return (new AppointmentCreated($this->appointment))->to($address);
        }
        return false;
    }

    public function toEmail($notifiable)
    {
        if ($this->isActiveDriver($notifiable, 'mymail')) {
            $message = new AppointmentCreated($this->appointment);
            return $message;
        }
        return false;
    }

    public function toWhatsApp($notifiable)
    {
        if ($this->isActiveDriver($notifiable, 'whatsapp')) {
            $orderUrl = url("/appointments/{$this->appointment->id}");         
            return (new WhatsAppMessage)
                ->content("Has agendado una consulta al paciente " . $this->appointment->patient->fullName . " en la fecha" . $this->appointment->init . ". Detalles: $orderUrl");
        }
        return false;
    }

    /**
     * Determine if the notification should be sent.
     *
     * @param  mixed  $notifiable
     * @param  string  $channel
     * @return bool
     */
    public function shouldSend($notifiable, $channel)
    {
        return $this->appointment->status < 4;
    }

    public function shouldInterrupt($notifiable)
    {
        return $notifiable->isInactive() || $this->appointment->status > 3;
    }

    /**
     * Get the Vonage / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \App\Channels\Messages\SmsMessage
     */
    public function toSms($notifiable)
    {
        $orderUrl = url("/appointments/{$this->appointment->id}");
        if ($this->isActiveDriver($notifiable, 'sms'))
            return (new SmsMessage)->content("Has agendado una consulta al paciente " . $this->appointment->patient->fullName . " en la fecha" . $this->appointment->init . ". Detalles: $orderUrl");
        return false;
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
