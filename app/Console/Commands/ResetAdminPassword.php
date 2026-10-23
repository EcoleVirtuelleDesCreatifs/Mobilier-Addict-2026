<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ResetAdminPassword extends Command
{
    protected $signature = 'admin:reset-password
                            {email : Email du compte}
                            {password? : Nouveau mot de passe (sinon genere)}
                            {--create : Creer le compte s il n existe pas}';

    protected $description = 'Reinitialise le mot de passe d un compte admin';

    public function handle(): int
    {
        $email = strtolower(trim($this->argument('email')));
        $password = $this->argument('password') ?: \Illuminate\Support\Str::random(16);

        $user = User::where('email', $email)->first();

        if (!$user) {
            if (!$this->option('create')) {
                $this->error("Aucun compte avec l email {$email}.");
                $this->line('Comptes existants :');
                User::select('email', 'role')->each(fn ($u) => $this->line(" - {$u->email} ({$u->role})"));
                $this->line('Utilise --create pour creer ce compte.');

                return self::FAILURE;
            }

            $user = new User();
            $user->email = $email;
            $user->name = 'Administrateur';
            $user->email_verified_at = now();
        }

        $user->password = $password;
        $user->is_admin = true;
        $user->role = in_array($user->role, ['super_admin', 'admin', 'editor', 'writer'], true) ? $user->role : 'admin';
        $user->is_active = true;
        $user->save();

        $this->info("Mot de passe reinitialise pour {$email}");
        $this->line("Role : {$user->role} | is_admin : " . ($user->is_admin ? 'oui' : 'non'));
        $this->warn("Nouveau mot de passe : {$password}");

        return self::SUCCESS;
    }
}
