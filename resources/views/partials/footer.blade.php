<footer class="footer-new">
    <div class="footer-new__newsletter">
        <div class="container footer-new__newsletter-inner">
            <div class="footer-new__newsletter-content">
                <h3 class="footer-new__newsletter-title">Rejoignez la Communauté du Bien-Dormir</h3>
                <p class="footer-new__newsletter-text">Recevez nos offres exclusives, conseils d'experts et les dernières tendances literie.</p>
            </div>
            <form class="footer-new__newsletter-form">
                @csrf
                <input type="email" placeholder="Votre adresse email" required />
                <button type="submit">S'inscrire <svg viewBox="0 0 24 24" width="16" height="16"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg></button>
            </form>
        </div>
    </div>

    <div class="footer-new__main">
        <div class="container footer-new__grid">
            <div class="footer-new__brand">
                <a class="footer-new__logo" href="{{ route('home') }}">
                    <img src="{{ asset('assets/logo/mobile/logo.png') }}" alt="Mobilier Addict" />
                </a>
                <p class="footer-new__desc">Votre partenaire sommeil depuis 2015. Nous sélectionnons les meilleurs produits pour transformer vos nuits.</p>
                <div class="footer-new__social">
                    <a href="#" aria-label="Facebook"><svg viewBox="0 0 24 24" width="20" height="20"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" stroke="currentColor" stroke-width="2" fill="none"/></svg></a>
                    <a href="#" aria-label="Instagram"><svg viewBox="0 0 24 24" width="20" height="20"><rect x="2" y="2" width="20" height="20" rx="5" stroke="currentColor" stroke-width="2" fill="none"/><circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="2" fill="none"/><circle cx="17.5" cy="6.5" r="1.5" fill="currentColor"/></svg></a>
                    <a href="#" aria-label="WhatsApp"><svg viewBox="0 0 24 24" width="20" height="20"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" stroke="currentColor" stroke-width="2" fill="none"/></svg></a>
                    <a href="#" aria-label="YouTube"><svg viewBox="0 0 24 24" width="20" height="20"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z" stroke="currentColor" stroke-width="2" fill="none"/><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" fill="currentColor"/></svg></a>
                </div>
            </div>

            <div class="footer-new__col">
                <h4 class="footer-new__title">Nos Produits</h4>
                <a class="footer-new__link" href="#">Matelas</a>
                <a class="footer-new__link" href="#">Oreillers</a>
                <a class="footer-new__link" href="#">Draps & Couettes</a>
                <a class="footer-new__link" href="#">Protège-Matelas</a>
                <a class="footer-new__link" href="#">Lits & Sommiers</a>
                <a class="footer-new__link" href="#">Électroménager</a>
            </div>

            <div class="footer-new__col">
                <h4 class="footer-new__title">Informations</h4>
                <a class="footer-new__link" href="#">À propos de nous</a>
                <a class="footer-new__link" href="#">Contactez-nous</a>
                <a class="footer-new__link" href="#">Service client</a>
                <a class="footer-new__link" href="#">Livraison & Retours</a>
                <a class="footer-new__link" href="#">FAQ</a>
            </div>

            <div class="footer-new__col">
                <h4 class="footer-new__title">Conseils Expert</h4>
                <a class="footer-new__link" href="#">Guide d'achat matelas</a>
                <a class="footer-new__link" href="#">Blog du sommeil</a>
                <a class="footer-new__link" href="#">Choisir son oreiller</a>
                <a class="footer-new__link" href="#">Entretien literie</a>
            </div>

            <div class="footer-new__col">
                <h4 class="footer-new__title">Contact</h4>
                <div class="footer-new__contact">
                    <span>📍 Abidjan, Côte d'Ivoire</span>
                    <span>📞 +225 0799140356</span>
                    <span>✉️ contact@mobilier-addict.com</span>
                    <span>🕐 Lun-Sam: 9h-19h</span>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-new__bottom">
        <div class="container footer-new__bottom-inner">
            <p class="footer-new__copy">© {{ date('Y') }} Mobilier Addict. Tous droits réservés.</p>
            <div class="footer-new__legal">
                <a href="#">Mentions légales</a>
                <a href="#">Politique de confidentialité</a>
                <a href="#">CGV</a>
            </div>
            <div class="footer-new__payments">
                <span>💳</span>
                <span>🏦</span>
                <span>📱</span>
            </div>
        </div>
    </div>
</footer>
