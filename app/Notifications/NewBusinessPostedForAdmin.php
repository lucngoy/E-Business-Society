<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class NewBusinessPostedForAdmin extends Notification
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
            'message' => "A new business '{$this->business->business_name}' has been posted and is awaiting approval. You can review the details and approve or reject it.",
            'url' => route('businesses.show', $this->business),
        ];
    }
}
