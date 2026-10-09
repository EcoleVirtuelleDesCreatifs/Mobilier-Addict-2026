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
            ->subject('COMPTE ADMINISTRATEUR - MOBILIER ADDICT')
            ->greeting('Bonjour' . (!empty($notifiable->name) ? ' ' . $notifiable->name : '') . ',')
            ->line("Vous êtes invité à administrer le site Mobilier Addict.")
            ->line("Pour activer votre compte, choisissez votre mot de passe en cliquant sur le bouton ci-dessous.")
            ->action('Créer mon mot de passe maintenant', $resetUrl)
            ->line('Ce lien est sécurisé et expirera dans 60 minutes.')
            ->line("Si vous n’êtes pas à l’origine de cette demande, vous pouvez ignorer cet email.")
            ->salutation('À très vite,\nL’équipe Mobilier Addict');
    }
}
