<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Connexion | Mobilier Addict</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/logo/favicon.png') }}">
    <link rel="stylesheet" href="{{ \App\Support\AdminShell::asset('assets/admin-app/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ \App\Support\AdminShell::asset('assets/admin-app/vendor/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ \App\Support\AdminShell::asset('assets/admin-app/css/admin.css') }}">
    <link rel="stylesheet" href="{{ \App\Support\AdminShell::asset('assets/admin-app/css/login.css') }}">
</head>
<body class="ad-body ad-login">
    <main class="ad-login-shell">
        <section class="ad-login-brand" aria-hidden="true">
            <img src="{{ asset('assets/logo/mobile/logo.png') }}" alt="" class="ad-login-logo">
            <div class="ad-login-pitch">
                <h2>Pilotez votre boutique en toute simplicité.</h2>
                <ul>
                    <li><i class="fa-solid fa-couch"></i> Catalogue et stocks</li>
                    <li><i class="fa-solid fa-bag-shopping"></i> Commandes, devis et factures</li>
                    <li><i class="fa-solid fa-chart-line"></i> Trafic et origine des visiteurs</li>
                </ul>
            </div>
            <small>© {{ date('Y') }} Mobilier Addict</small>
        </section>

        <section class="ad-login-panel">
            <div class="ad-login-card">
                <img src="{{ asset('assets/logo/mobile/logo.png') }}" alt="Mobilier Addict" class="ad-login-logo-mobile">

                <h1>Connexion</h1>
                <p class="ad-login-sub">Accède à l'espace d'administration.</p>

                @if (session('status'))
                    <div class="alert alert-success" role="status">{{ session('status') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger d-flex gap-2 align-items-start" role="alert">
                        <i class="fa-solid fa-circle-exclamation mt-1"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" id="ad-login-form" novalidate>
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse e-mail</label>
                        <div class="ad-input-icon">
                            <i class="fa-regular fa-envelope"></i>
                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="nom@mobilier-addict.com" autocomplete="username" required autofocus>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="password" class="form-label">Mot de passe</label>
                            <a href="{{ route('password.request') }}" class="ad-login-link">Mot de passe oublié ?</a>
                        </div>
                        <div class="ad-input-icon">
                            <i class="fa-solid fa-lock"></i>
                            <input id="password" type="password" name="password"
                                   class="form-control ad-login-password @error('password') is-invalid @enderror"
                                   placeholder="••••••••" autocomplete="current-password" required>
                            <button type="button" class="ad-login-toggle" data-toggle-password aria-label="Afficher le mot de passe">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                        <div class="ad-login-caps" data-caps hidden><i class="fa-solid fa-triangle-exclamation"></i> Verrouillage majuscules activé</div>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" value="1" @checked(old('remember'))>
                        <label class="form-check-label" for="remember">Se souvenir de moi</label>
                    </div>

                    <button type="submit" class="btn btn-admin-pink w-100 ad-login-submit">
                        <span class="ad-login-label">Se connecter</span>
                        <span class="ad-login-loading" hidden><span class="spinner-border spinner-border-sm me-2"></span>Connexion…</span>
                    </button>
                </form>

                <a href="{{ url('/') }}" class="ad-login-back"><i class="fa-solid fa-arrow-left me-1"></i> Retour au site</a>
            </div>
        </section>
    </main>

    <script defer src="{{ \App\Support\AdminShell::asset('assets/admin-app/js/pages/login.js') }}"></script>
</body>
</html>
