<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BusinessDeleted extends Notification
{
    use Queueable;

    public $businessName;

    /**
     * Create a new notification instance.
     */
    public function __construct($businessName)
    {
        $this->businessName = $businessName;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['mail', 'database']; // Notifications par email et en base de données
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject('Your Business Has Been Deleted')
            ->line("Your business '{$this->businessName}' has been deleted by the administrator.")
            ->line('If you have any questions, feel free to contact support.');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable)
    {
        return [
            'business_name' => $this->businessName,
        ];
    }
}
