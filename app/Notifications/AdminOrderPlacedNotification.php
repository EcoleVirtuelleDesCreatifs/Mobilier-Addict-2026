<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminOrderPlacedNotification extends Notification
{
    use Queueable;

    public function __construct(private readonly Order $order)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toArray(object $notifiable): array
    {
        $order = $this->order;

        return [
            'order_id' => $order->id,
            'title' => 'Nouvelle commande #' . $order->id,
            'message' => 'Total : ' . number_format((float) $order->total, 0, ',', '.') . ' F',
            'url' => url(route('admin.orders.show', $order, false)),
            'created_at' => now()->toISOString(),
        ];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $order = $this->order;

        $subject = 'Nouvelle commande #' . $order->id;

        $customerName = trim(($order->firstnames ?? '') . ' ' . ($order->lastname ?? ''));
        $customerLine = $customerName !== '' ? $customerName : 'Client';

        $adminUrl = url(route('admin.orders.show', $order, false));

        return (new MailMessage)
            ->subject($subject)
            ->greeting('Nouvelle commande à traiter')
            ->line($customerLine)
            ->line('Total : ' . number_format((float) $order->total, 0, ',', '.') . ' F')
            ->line('Mode de livraison : ' . ($order->shipping_method ?: '—'))
            ->action('Voir la commande', $adminUrl)
            ->line('Merci de prendre en charge la commande rapidement.');
    }
}
