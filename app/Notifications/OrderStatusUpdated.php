<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Order;

class OrderStatusUpdated extends Notification
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Order Status Updated')
            ->line('The status of your order has been updated.')
            ->line('Order ID: ' . $this->order->id)
            ->line('Product Details:')
            ->line($this->order->orderItems->map(function ($item) {
                return $item->product->title . ' x ' . $item->quantity;
            })->implode(', '))
            ->line('New Status: ' . $this->order->status);
    }
}
