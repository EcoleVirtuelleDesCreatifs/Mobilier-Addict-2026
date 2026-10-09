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

        $customerName = trim(($order->firstnames ?? '') . ' ' . ($order->lastname ?? ''));
        $customerLine = $customerName !== '' ? $customerName : 'Client';

        $adminUrl = url(route('admin.orders.show', $order, false));

        return (new MailMessage)
            ->subject('[Commande #' . $order->id . '] Nouvelle vente à traiter')
            ->greeting('Nouvelle commande reçue')
            ->line('Une nouvelle commande vient d’être enregistrée sur le site Mobilier Addict.')
            ->line('**Référence :** #' . $order->id)
            ->line('**Client :** ' . $customerLine)
            ->line('**Contact :** ' . ($order->phone ?: ($order->whatsapp ?: '—')))
            ->line('**Montant total :** ' . number_format((float) $order->total, 0, ',', '.') . ' FCFA')
            ->line('**Livraison :** ' . ($order->shipping_method ?: 'À définir') . ' — ' . ($order->delivery_place ?: 'Lieu non renseigné'))
            ->action('Ouvrir la commande', $adminUrl)
            ->line('Merci de vérifier les articles, le paiement et les modalités de livraison avant de contacter le client.')
            ->salutation('Administration Mobilier Addict');
    }
}
