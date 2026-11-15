@php
/**
 * Barre d'annonce (haut de page).
 * Variables optionnelles avant l'include :
 *   $announcement_text  : message central personnalisé
 *   $announcement_bg    : classe de fond ('bg-1' rose par défaut)
 *   $announcement_fluid : true pour un conteneur pleine largeur
 */
$announcement_text  = $announcement_text ?? null;
$announcement_bg    = $announcement_bg ?? 'bg-1';
$announcement_fluid = $announcement_fluid ?? false;
@endphp
      <!-- announcement bar start -->
      <div class="announcement-bar announcement-ma {{ $announcement_bg }}">
        <div class="{{ $announcement_fluid ? 'container-fluid' : 'container' }}">
          <div class="announcement-ma-row">
            <p class="announcement-text announcement-ma-msg">
              @if($announcement_text !== null)
                {{ $announcement_text }}
              @else
                <strong>Black Friday</strong> · 1 matelas acheté, 2 oreillers offerts — jusqu’au 30 novembre
              @endif
            </p>
            <a class="announcement-text announcement-ma-link" href="{{ route('menu.show', 'matelas') }}">J’en profite <span aria-hidden="true">→</span></a>
          </div>
        </div>
      </div>
      <!-- announcement bar end -->
@php unset($announcement_text, $announcement_bg, $announcement_fluid); @endphp
