<?php

namespace App\Notifications;

use App\Models\Quote;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class QuoteConfirmationNotification extends Notification
{
    use Queueable;

    public function __construct(private readonly Quote $quote)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $quote = $this->quote;
        $contact = trim(($quote->firstnames ?? '') . ' ' . ($quote->lastname ?? ''));

        $mail = (new MailMessage)
            ->subject('Confirmation de votre demande de devis ' . $quote->number . ' - Mobilier Addict')
            ->greeting('Bonjour ' . ($contact !== '' ? $contact : 'Client') . ',')
            ->line('Nous avons bien reçu votre demande de devis. Voici le récapitulatif :')
            ->line('')
            ->line('**Référence** : ' . $quote->number)
            ->line('**Structure** : ' . ($quote->company_name ?? '—'))
            ->line('**Type de structure** : ' . (self::organizationLabel($quote->organization_type) ?? '—'))
            ->line('**Contact** : ' . ($contact !== '' ? $contact : '—'))
            ->line('**WhatsApp** : ' . ($quote->whatsapp ?? '—'))
            ->when($quote->phone, fn (MailMessage $m) => $m->line('**Téléphone** : ' . $quote->phone))
            ->when($quote->email, fn (MailMessage $m) => $m->line('**E-mail** : ' . $quote->email))
            ->when($quote->delivery_place, fn (MailMessage $m) => $m->line('**Lieu de livraison** : ' . $quote->delivery_place))
            ->when($quote->delivery_day, fn (MailMessage $m) => $m->line('**Date de livraison souhaitée** : ' . $quote->delivery_day->format('d/m/Y')))
            ->when($quote->budget_range, fn (MailMessage $m) => $m->line('**Budget indicatif** : ' . (self::budgetLabel($quote->budget_range) ?? '—')))
            ->line('')
            ->line('**Détail de votre besoin** :')
            ->line($quote->details)
            ->line('')
            ->line('Notre équipe étudie votre demande et vous recontactera rapidement par WhatsApp ou par téléphone.')
            ->line('Merci de votre confiance.');

        return $mail;
    }

    private static function organizationLabel(?string $key): ?string
    {
        $labels = [
            'entreprise' => 'Entreprise',
            'institution' => 'Institution publique',
            'hotellerie' => 'Hôtel / Hôtellerie',
            'restaurant' => 'Restaurant / Café',
            'ong' => 'ONG / Association',
            'bureau' => 'Bureau / Coworking',
            'autre' => 'Autre structure',
        ];

        return $key && isset($labels[$key]) ? $labels[$key] : null;
    }

    private static function budgetLabel(?string $key): ?string
    {
        $labels = [
            'lt500k' => 'Moins de 500 000 FCFA',
            '500k-1m' => '500 000 – 1 000 000 FCFA',
            '1m-5m' => '1 000 000 – 5 000 000 FCFA',
            'gt5m' => 'Plus de 5 000 000 FCFA',
            'unknown' => 'À définir ensemble',
        ];

        return $key && isset($labels[$key]) ? $labels[$key] : null;
    }
}
