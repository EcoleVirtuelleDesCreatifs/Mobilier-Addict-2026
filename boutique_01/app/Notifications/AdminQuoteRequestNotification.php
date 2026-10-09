<?php

namespace App\Notifications;

use App\Models\Quote;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminQuoteRequestNotification extends Notification
{
    use Queueable;

    public function __construct(private readonly Quote $quote)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toArray(object $notifiable): array
    {
        $quote = $this->quote;

        return [
            'quote_id' => $quote->id,
            'title' => 'Nouvelle demande de devis ' . $quote->number,
            'message' => ($quote->company_name ?: 'Structure') . ' — ' . trim(($quote->firstnames ?? '') . ' ' . ($quote->lastname ?? '')),
            'url' => url(route('admin.quotes.show', $quote, false)),
            'created_at' => now()->toISOString(),
        ];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $quote = $this->quote;
        $contact = trim(($quote->firstnames ?? '') . ' ' . ($quote->lastname ?? ''));

        return (new MailMessage)
            ->subject('Nouvelle demande de devis ' . $quote->number . ' - Mobilier Addict')
            ->greeting('Demande de devis reçue')
            ->line('Référence : ' . $quote->number)
            ->line('Structure : ' . ($quote->company_name ?? '—'))
            ->line('Contact : ' . ($contact !== '' ? $contact : '—'))
            ->line('WhatsApp : ' . ($quote->whatsapp ?? '—'))
            ->when($quote->email, fn ($mail) => $mail->line('E-mail : ' . $quote->email))
            ->action('Voir la demande', url(route('admin.quotes.show', $quote, false)));
    }
}
