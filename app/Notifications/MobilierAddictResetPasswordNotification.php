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
            ->subject('Réinitialisation de votre mot de passe Mobilier Addict')
            ->greeting('Bonjour' . (!empty($notifiable->name) ? ' ' . $notifiable->name : '') . ',')
            ->line('Nous avons reçu une demande de réinitialisation du mot de passe associé à votre compte.')
            ->action('Choisir un nouveau mot de passe', $resetUrl)
            ->line('Pour votre sécurité, ce lien personnel expirera dans 60 minutes et ne pourra être utilisé qu’une seule fois.')
            ->line('Si vous n’êtes pas à l’origine de cette demande, aucune action n’est nécessaire. Votre mot de passe actuel reste inchangé.')
            ->salutation("Bien cordialement,\nL’équipe Mobilier Addict");
    }
}
