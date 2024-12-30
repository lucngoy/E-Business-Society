<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class BusinessDeletedByOwner extends Notification
{
    protected $business;

    public function __construct($business)
    {
        $this->business = $business;
    }

    public function via($notifiable)
    {
        return ['database']; // Vous pouvez aussi utiliser 'mail' si vous souhaitez envoyer des emails
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "The business '{$this->business->business_name}' has been deleted by its owner.",
        ];
    }
}

