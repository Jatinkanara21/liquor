<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewProductNotification extends Notification
{
    use Queueable;

    public $productName;
    public $productDescription;
    public $productId;

    /**
     * Create a new notification instance.
     */
    public function __construct($productName, $productDescription, $productId)
    {
        $this->productName = $productName;
        $this->productDescription = $productDescription;
        $this->productId = $productId;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'new_product',
            'product_name' => $this->productName,
            'product_description' => $this->productDescription,
            'product_id' => $this->productId,
            'message' => 'A new product has been added: ' . $this->productName,
        ];
    }
}
