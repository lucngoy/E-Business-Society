<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class NewBusinessPostedForUser extends Notification
{
    protected $business;

    public function __construct($business)
    {
        $this->business = $business;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'business_id' => $this->business->id,
            'message' => "A new business '{$this->business->business_name}' has been posted! Check it out!",
            'url' => route('businesses.show', $this->business),
        ];
    }
}
