<?php
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
?>
      <!-- announcement bar start -->
      <div class="announcement-bar announcement-ma <?= htmlspecialchars($announcement_bg, ENT_QUOTES, 'UTF-8') ?> py-1 py-lg-2">
        <div class="<?= $announcement_fluid ? 'container-fluid' : 'container' ?>">
          <div class="announcement-ma-row d-flex align-items-center justify-content-between">
            <a class="announcement-text announcement-ma-side d-none d-lg-inline-flex align-items-center" href="tel:+2250799140356">
              <svg class="icon icon-phone" xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
              </svg>
              <span class="ms-2">Appelez : +225 07 99 14 03 56</span>
            </a>
            <p class="announcement-text announcement-ma-msg text-white mb-0"><?= htmlspecialchars($announcement_text, ENT_QUOTES, 'UTF-8') ?></p>
            <div class="announcement-ma-side d-none d-lg-flex align-items-center">
              <a class="announcement-text announcement-ma-link" href="contact.php">Contact</a>
              <span class="announcement-ma-dot" aria-hidden="true"></span>
              <a class="announcement-login announcement-text announcement-ma-link d-inline-flex align-items-center" href="login.php">
                <svg class="icon icon-user" width="10" height="11" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M5 0C3.07227 0 1.5 1.57227 1.5 3.5C1.5 4.70508 2.11523 5.77539 3.04688 6.40625C1.26367 7.17188 0 8.94141 0 11H1C1 8.78516 2.78516 7 5 7C7.21484 7 9 8.78516 9 11H10C10 8.94141 8.73633 7.17188 6.95312 6.40625C7.88477 5.77539 8.5 4.70508 8.5 3.5C8.5 1.57227 6.92773 0 5 0ZM5 1C6.38672 1 7.5 2.11328 7.5 3.5C7.5 4.88672 6.38672 6 5 6C3.61328 6 2.5 4.88672 2.5 3.5C2.5 2.11328 3.61328 1 5 1Z" fill="#fff" />
                </svg>
                <span class="ms-2">Connexion</span>
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- announcement bar end -->
<?php unset($announcement_text, $announcement_bg, $announcement_fluid); ?>
