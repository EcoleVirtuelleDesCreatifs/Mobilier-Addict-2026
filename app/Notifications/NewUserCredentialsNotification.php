<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewUserCredentialsNotification extends Notification
{
    use Queueable;

    public function __construct(
        private readonly string $plainPassword
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $loginUrl = url('/login');

        $name = trim((string) ($notifiable->name ?? ''));

        return (new MailMessage)
            ->subject('Votre accès à l’administration Mobilier Addict')
            ->greeting('Bonjour' . ($name !== '' ? ' ' . $name : '') . ',')
            ->line('Votre compte administrateur Mobilier Addict est maintenant disponible.')
            ->line('**Adresse e-mail :** ' . ($notifiable->email ?? ''))
            ->line('**Mot de passe temporaire :** ' . $this->plainPassword)
            ->action('Accéder à mon compte', $loginUrl)
            ->line('Pour protéger votre accès, connectez-vous puis remplacez immédiatement ce mot de passe temporaire depuis votre profil.')
            ->line('Si vous ne reconnaissez pas cette invitation, contactez l’administrateur du site sans utiliser ces identifiants.')
            ->salutation('L’équipe Mobilier Addict');
    }
}
