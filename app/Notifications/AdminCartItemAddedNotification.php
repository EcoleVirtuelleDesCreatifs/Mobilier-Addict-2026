<?php

namespace App\Notifications;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AdminCartItemAddedNotification extends Notification
{
    use Queueable;

    public function __construct(
        private readonly Product $product,
        private readonly ?ProductVariant $variant,
        private readonly int $quantity
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        $variantLabel = null;
        if ($this->variant) {
            if (!empty($this->variant->variant_type)) {
                $variantLabel = $this->variant->variant_type . ' • ' . $this->variant->places . ' place(s)';
            } else {
                $variantLabel = $this->variant->thickness_cm . ' cm • ' . $this->variant->places . ' place(s)';
            }
        }

        $title = 'Ajout au panier';
        $message = $this->product->name;
        if ($variantLabel) {
            $message .= ' (' . $variantLabel . ')';
        }
        $message .= ' × ' . $this->quantity;

        return [
            'title' => $title,
            'message' => $message,
            'product_id' => $this->product->id,
            'product_variant_id' => $this->variant?->id,
            'quantity' => $this->quantity,
            'url' => url(route('admin.orders.index', [], false)),
            'created_at' => now()->toISOString(),
        ];
    }
}
