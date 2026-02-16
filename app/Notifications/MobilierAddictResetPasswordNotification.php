<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class MobilierAddictResetPasswordNotification extends ResetPassword
{
    public function toMail($notifiable): MailMessage
    {
        $resetUrl = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Créer / réinitialiser votre mot de passe - Mobilier Addict')
            ->greeting('Bonjour' . (!empty($notifiable->name) ? ' ' . $notifiable->name : '') . ',')
            ->line("Un compte administrateur vient d’être créé pour vous sur Mobilier Addict.")
            ->line("Pour accéder à votre espace, définissez votre mot de passe en cliquant sur le bouton ci-dessous.")
            ->action('Créer mon mot de passe', $resetUrl)
            ->line('Ce lien expirera dans 60 minutes.')
            ->line("Si vous n’êtes pas à l’origine de cette demande, vous pouvez ignorer cet email.")
            ->salutation('Cordialement,\nMobilier Addict');
    }
}
