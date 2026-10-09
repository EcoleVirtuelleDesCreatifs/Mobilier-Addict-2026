{{--
|--------------------------------------------------------------------------
| TOPBAR - Barre supérieure InCotedivoire V3
|--------------------------------------------------------------------------
| Barre d'information supérieure avec :
| - Message de bienvenue
| - Météo et date
| - Réseaux sociaux
| - Liens rapides
|--------------------------------------------------------------------------
--}}

<div class="topbar-modern">
    <div class="container">
        <div class="topbar-content">
            {{-- Section gauche : Message et informations --}}
            <div class="topbar-left">
                <div class="topbar-item welcome-message">
                    <i class="ti-announcement"></i>
                    <span class="topbar-text">Bienvenue sur InCotedivoire</span>
                </div>

                <div class="topbar-item weather-info">
                    <i class="ti-cloud"></i>
                    <span class="topbar-text">
                        <span id="temperature">34°C</span>,
                        <span id="weather-status">Ensoleillé</span>
                    </span>
                </div>

                <div class="topbar-item date-info">
                    <i class="ti-calendar"></i>
                    <span class="topbar-text" id="current-date">
                        {{ \Carbon\Carbon::now()->locale('fr')->isoFormat('dddd, D MMMM YYYY') }}
                    </span>
                </div>
            </div>

            {{-- Section droite : Réseaux sociaux et liens --}}
            <div class="topbar-right">
                {{-- Réseaux sociaux --}}
                <div class="topbar-social">
                    <a href="https://facebook.com/incotedivoire" target="_blank" class="social-link facebook" aria-label="Facebook">
                        <i class="ti-facebook"></i>
                    </a>
                    <a href="https://twitter.com/incotedivoire" target="_blank" class="social-link twitter" aria-label="Twitter">
                        <i class="ti-twitter-alt"></i>
                    </a>
                    <a href="https://instagram.com/incotedivoire" target="_blank" class="social-link instagram" aria-label="Instagram">
                        <i class="ti-instagram"></i>
                    </a>
                    <a href="https://youtube.com/incotedivoire" target="_blank" class="social-link youtube" aria-label="YouTube">
                        <i class="ti-youtube"></i>
                    </a>
                    <a href="https://linkedin.com/company/incotedivoire" target="_blank" class="social-link linkedin" aria-label="LinkedIn">
                        <i class="ti-linkedin"></i>
                    </a>
                </div>

                {{-- Séparateur --}}
                <div class="topbar-divider"></div>

                {{-- Liens rapides --}}
                <div class="topbar-links">
                    <a href="/contact" class="topbar-link">
                        <i class="ti-email"></i>
                        <span>Contact</span>
                    </a>
                    <a href="/about" class="topbar-link">
                        <i class="ti-info-alt"></i>
                        <span>À propos</span>
                    </a>
                    @auth
                        <a href="/in/admin/dashboard" class="topbar-link">
                            <i class="ti-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    @else
                        <a href="/login" class="topbar-link">
                            <i class="ti-user"></i>
                            <span>Connexion</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script pour la mise à jour de la date/heure --}}
@push('scripts')
<script>
    // Mise à jour de la date et heure en temps réel
    function updateDateTime() {
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        const date = new Date().toLocaleDateString('fr-FR', options);
        const dateElement = document.getElementById('current-date');
        if (dateElement) {
            dateElement.textContent = date.charAt(0).toUpperCase() + date.slice(1);
        }
    }

    // Mise à jour toutes les minutes
    setInterval(updateDateTime, 60000);
    updateDateTime();
</script>
@endpush
