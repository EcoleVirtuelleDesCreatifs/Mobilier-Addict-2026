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
            ->subject('[Devis ' . $quote->number . '] Nouvelle demande client')
            ->greeting('Nouvelle demande de devis')
            ->line('Une demande sur mesure vient d’être envoyée depuis le site Mobilier Addict.')
            ->line('**Référence :** ' . $quote->number)
            ->line('**Structure :** ' . ($quote->company_name ?: 'Non renseignée'))
            ->line('**Contact :** ' . ($contact !== '' ? $contact : 'Non renseigné'))
            ->line('**WhatsApp :** ' . ($quote->whatsapp ?: 'Non renseigné'))
            ->when($quote->email, fn (MailMessage $mail) => $mail->line('**E-mail :** ' . $quote->email))
            ->when($quote->budget_range, fn (MailMessage $mail) => $mail->line('**Budget indicatif :** ' . $quote->budget_range))
            ->line('**Besoin exprimé :**')
            ->line($quote->details ?: 'Aucun détail fourni.')
            ->action('Préparer le devis', url(route('admin.quotes.show', $quote, false)))
            ->line('Traitez la demande depuis l’administration puis contactez le client avec une proposition adaptée.')
            ->salutation('Administration Mobilier Addict');
    }
}
