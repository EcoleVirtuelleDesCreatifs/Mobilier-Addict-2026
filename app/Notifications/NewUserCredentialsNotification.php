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
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $loginUrl = url('/login');

        return (new MailMessage)
            ->subject('Vos accès - Mobilier Addict')
            ->greeting('Bonjour ' . ($notifiable->name ?? '') . ',')
            ->line('Un compte vient d\'être créé pour vous sur Mobilier Addict.')
            ->line('Identifiants :')
            ->line('Email : ' . ($notifiable->email ?? ''))
            ->line('Mot de passe : ' . $this->plainPassword)
            ->action('Se connecter', $loginUrl)
            ->line('Pour des raisons de sécurité, vous pouvez modifier votre mot de passe après connexion.');
    }
}
