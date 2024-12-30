<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class BusinessStatusUpdated extends Notification
{
    public $business;

    // Le constructeur qui prend en paramètre un modèle Business
    public function __construct($business)
    {
        $this->business = $business;
    }

    // Spécifiez les canaux de notification
    public function via($notifiable)
    {
        return ['database'];
    }

    // Structure des données envoyées à la base de données
    public function toDatabase($notifiable)
    {
        return [
            'business_id' => $this->business->id,
            'status' => $this->business->status,
            'message' => "The status of the business '{$this->business->business_name}' has been updated. It is now marked as '{$this->business->status}'. You can view the updated business details by clik on view.",
            'url' => route('businesses.show', $this->business),
        ];
    }
}
