<?php

namespace App\Notifications;

use App\Models\Quote;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class QuoteConfirmationNotification extends Notification
{
    use Queueable;

    public function __construct(private readonly Quote $quote) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $quote = $this->quote;
        $contact = trim(($quote->firstnames ?? '') . ' ' . ($quote->lastname ?? ''));

        $mail = (new MailMessage)
            ->subject('Votre demande de devis ' . $quote->number . ' a bien été reçue')
            ->greeting('Bonjour ' . ($contact !== '' ? $contact : 'Client') . ',')
            ->line('Merci d’avoir contacté Mobilier Addict. Votre demande a bien été transmise à notre équipe commerciale.')
            ->line('**Référence de suivi :** ' . $quote->number)
            ->line('**Structure :** ' . ($quote->company_name ?: 'Non renseignée'))
            ->line('**Type de structure :** ' . (self::organizationLabel($quote->organization_type) ?? 'Non renseigné'))
            ->line('**WhatsApp :** ' . ($quote->whatsapp ?: 'Non renseigné'))
            ->when($quote->phone, fn (MailMessage $m) => $m->line('**Téléphone :** ' . $quote->phone))
            ->when($quote->delivery_place, fn (MailMessage $m) => $m->line('**Lieu de livraison :** ' . $quote->delivery_place))
            ->when($quote->delivery_day, fn (MailMessage $m) => $m->line('**Date souhaitée :** ' . $quote->delivery_day->format('d/m/Y')))
            ->when($quote->budget_range, fn (MailMessage $m) => $m->line('**Budget indicatif :** ' . (self::budgetLabel($quote->budget_range) ?? 'À définir')))
            ->line('**Votre besoin :**')
            ->line($quote->details ?: 'Aucun détail fourni.')
            ->line('Un conseiller étudiera votre projet et vous contactera par WhatsApp, téléphone ou e-mail afin de préciser les besoins et préparer une proposition adaptée.')
            ->line('Conservez la référence **' . $quote->number . '** pour faciliter le suivi de votre demande.')
            ->salutation("Merci pour votre confiance,\nL’équipe Mobilier Addict");

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
