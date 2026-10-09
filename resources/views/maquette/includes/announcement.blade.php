@php
/**
 * Barre d'annonce (haut de page).
 * Variables optionnelles avant l'include :
 *   $announcement_text  : message central personnalisé
 *   $announcement_bg    : classe de fond ('bg-1' rose par défaut)
 *   $announcement_fluid : true pour un conteneur pleine largeur
 */
$announcement_text  = $announcement_text  ?? 'Mobilier, literie et électroménager pour votre intérieur en Côte d’Ivoire';
$announcement_bg    = $announcement_bg    ?? 'bg-1';
$announcement_fluid = $announcement_fluid ?? false;
@endphp
      <!-- announcement bar start -->
      <div class="announcement-bar announcement-ma {{ htmlspecialchars($announcement_bg, ENT_QUOTES, 'UTF-8') }} py-1 py-lg-2">
        <div class="{{ $announcement_fluid ? 'container-fluid' : 'container' }}">
          <div class="announcement-ma-row d-flex align-items-center justify-content-between">
            <a class="announcement-text announcement-ma-side d-none d-lg-inline-flex align-items-center" href="tel:+2250799140356">
              <svg class="icon icon-phone" xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
              </svg>
              <span class="ms-2">Appelez : +225 07 99 14 03 56</span>
            </a>
            <p class="announcement-text announcement-ma-msg text-white mb-0 d-inline-flex align-items-center justify-content-center">
              <svg class="icon icon-truck" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="margin-right:8px;flex:0 0 auto"><path d="M10 17h4V5H2v12h3"/><path d="M20 17h2v-3.34a4 4 0 0 0-1.17-2.83L19 9h-5v8h1"/><circle cx="7.5" cy="17.5" r="2.5"/><circle cx="17.5" cy="17.5" r="2.5"/></svg>
              {{ htmlspecialchars($announcement_text, ENT_QUOTES, 'UTF-8') }}
            </p>
            <div class="announcement-ma-side d-none d-lg-flex align-items-center">
              <a class="announcement-text announcement-ma-link d-inline-flex align-items-center" href="{{ route('pages.contact') }}">
                <svg class="icon icon-mail" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="margin-right:7px"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-10 6L2 7"/></svg>
                Contact
              </a>

            </div>
          </div>
        </div>
      </div>
      <!-- announcement bar end -->
@php unset($announcement_text, $announcement_bg, $announcement_fluid); @endphp
