<footer class="footer-optimized">
    <style>
        .footer-optimized {
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
            color: #fff;
            position: relative;
            overflow: hidden
        }

        .footer-optimized__bg-decor {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none
        }

        .footer-optimized__bg-circle {
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%
        }

        .footer-optimized__bg-circle--top-right {
            top: -100px;
            right: -100px;
            background: radial-gradient(circle, rgba(236,72,153,.15) 0%, transparent 70%)
        }

        .footer-optimized__bg-circle--bottom-left {
            bottom: -100px;
            left: -100px;
            background: radial-gradient(circle, rgba(59,130,246,.15) 0%, transparent 70%)
        }

        .footer-optimized__newsletter {
            background: linear-gradient(135deg, #ec4899 0%, #be185d 100%);
            padding: 80px 0;
            position: relative
        }

        .footer-optimized__newsletter-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><circle cx=%2250%22 cy=%2250%22 r=%221%22 fill=%22rgba(255,255,255,.1)%22/></svg>');
            background-size: 20px 20px;
            opacity: .5
        }

        .footer-optimized__newsletter-content {
            text-align: center;
            max-width: 700px;
            margin: 0 auto;
            position: relative
        }

        .footer-optimized__badge {
            display: inline-block;
            padding: 8px 20px;
            background: rgba(255,255,255,.2);
            border-radius: 50px;
            margin-bottom: 24px
        }

        .footer-optimized__badge-text {
            color: #fff;
            font-size: 0.875rem;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase
        }

        .footer-optimized__newsletter-title {
            font-size: 3rem;
            font-weight: 900;
            margin: 0 0 20px;
            color: #fff;
            letter-spacing: -.02em;
            line-height: 1.1
        }

        .footer-optimized__newsletter-desc {
            font-size: 1.25rem;
            color: rgba(255,255,255,.95);
            margin: 0 0 40px;
            line-height: 1.6
        }

        .footer-optimized__newsletter-form {
            display: flex;
            gap: 16px;
            max-width: 550px;
            margin: 0 auto
        }

        .footer-optimized__newsletter-input {
            flex: 1;
            padding: 20px 28px;
            border-radius: 16px;
            border: 0;
            font-size: 1.0625rem;
            outline: none;
            box-shadow: 0 10px 40px rgba(0,0,0,.2)
        }

        .footer-optimized__newsletter-btn {
            background: #0f172a;
            color: #fff;
            padding: 20px 40px;
            border-radius: 16px;
            border: 0;
            font-weight: 800;
            font-size: 1.0625rem;
            cursor: pointer;
            transition: all .3s ease;
            box-shadow: 0 10px 40px rgba(0,0,0,.3);
            text-transform: uppercase;
            letter-spacing: 1px
        }

        .footer-optimized__newsletter-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 50px rgba(0,0,0,.4)
        }

        .footer-optimized__message {
            margin-top: 20px;
            color: #fff;
            font-size: 1rem;
            background: rgba(255,255,255,.2);
            padding: 12px 24px;
            border-radius: 12px;
            display: inline-block
        }

        .footer-optimized__main {
            padding: 100px 0;
            position: relative
        }

        .footer-optimized__grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 64px
        }

        .footer-optimized__brand-logo {
            display: inline-block;
            margin-bottom: 32px
        }

        .footer-optimized__brand-logo img {
            height: 56px
        }

        .footer-optimized__brand-desc {
            color: rgba(255,255,255,.8);
            font-size: 1.0625rem;
            line-height: 1.7;
            margin: 0 0 32px;
            letter-spacing: -.01em
        }

        .footer-optimized__social {
            display: flex;
            gap: 16px
        }

        .footer-optimized__social-link {
            width: 52px;
            height: 52px;
            background: rgba(255,255,255,.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            transition: all .3s ease;
            border: 1px solid rgba(255,255,255,.1)
        }

        .footer-optimized__social-link:hover {
            background: rgba(255,255,255,.2);
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0,0,0,.2)
        }

        .footer-optimized__section-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 50px;
            margin-bottom: 24px;
            border: 1px solid
        }

        .footer-optimized__section-badge--pink {
            background: rgba(236,72,153,.15);
            border-color: rgba(236,72,153,.3)
        }

        .footer-optimized__section-badge--blue {
            background: rgba(59,130,246,.15);
            border-color: rgba(59,130,246,.3)
        }

        .footer-optimized__section-badge--green {
            background: rgba(16,185,129,.15);
            border-color: rgba(16,185,129,.3)
        }

        .footer-optimized__section-badge-text {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase
        }

        .footer-optimized__section-badge--pink .footer-optimized__section-badge-text {
            color: #ec4899
        }

        .footer-optimized__section-badge--blue .footer-optimized__section-badge-text {
            color: #3b82f6
        }

        .footer-optimized__section-badge--green .footer-optimized__section-badge-text {
            color: #10b981
        }

        .footer-optimized__section-title {
            font-size: 1.5rem;
            font-weight: 800;
            margin: 0 0 28px;
            color: #fff;
            letter-spacing: -.01em
        }

        .footer-optimized__links {
            display: flex;
            flex-direction: column;
            gap: 16px
        }

        .footer-optimized__link {
            color: rgba(255,255,255,.8);
            text-decoration: none;
            font-size: 1rem;
            transition: all .3s ease;
            display: flex;
            align-items: center;
            gap: 12px
        }

        .footer-optimized__link:hover {
            color: #fff;
            transform: translateX(5px)
        }

        .footer-optimized__link-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%
        }

        .footer-optimized__link-dot--pink {
            background: #ec4899
        }

        .footer-optimized__link-dot--blue {
            background: #3b82f6
        }

        .footer-optimized__contact-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px;
            background: rgba(255,255,255,.05);
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,.1);
            transition: all .3s ease
        }

        .footer-optimized__contact-item:hover {
            background: rgba(255,255,255,.08);
            transform: translateX(5px)
        }

        .footer-optimized__contact-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem
        }

        .footer-optimized__contact-icon--pink {
            background: linear-gradient(135deg, #ec4899, #be185d)
        }

        .footer-optimized__contact-icon--blue {
            background: linear-gradient(135deg, #3b82f6, #2563eb)
        }

        .footer-optimized__contact-icon--green {
            background: linear-gradient(135deg, #10b981, #059669)
        }

        .footer-optimized__contact-icon--orange {
            background: linear-gradient(135deg, #f59e0b, #d97706)
        }

        .footer-optimized__contact-text {
            color: rgba(255,255,255,.9);
            font-size: 1rem;
            font-weight: 500
        }

        .footer-optimized__contact-link {
            color: rgba(255,255,255,.9);
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500
        }

        .footer-optimized__b2b-btn {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: #fff;
            padding: 16px 32px;
            border-radius: 16px;
            text-decoration: none;
            font-weight: 800;
            font-size: 1rem;
            transition: all .3s ease;
            box-shadow: 0 10px 30px rgba(59,130,246,.3);
            text-transform: uppercase;
            letter-spacing: 1px
        }

        .footer-optimized__b2b-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(59,130,246,.4)
        }

        .footer-optimized__bottom {
            background: rgba(0,0,0,.4);
            padding: 32px 0;
            position: relative
        }

        .footer-optimized__bottom-content {
            display: flex;
            flex-direction: column;
            gap: 20px;
            align-items: center
        }

        .footer-optimized__copyright {
            color: rgba(255,255,255,.7);
            font-size: 0.9375rem;
            margin: 0;
            letter-spacing: -.01em
        }

        .footer-optimized__legal-links {
            display: flex;
            gap: 32px;
            flex-wrap: wrap;
            justify-content: center
        }

        .footer-optimized__legal-link {
            color: rgba(255,255,255,.7);
            text-decoration: none;
            font-size: 0.875rem;
            transition: color .3s ease;
            position: relative
        }

        .footer-optimized__legal-link:hover {
            color: #fff
        }

        @media (max-width: 768px) {
            .footer-optimized__newsletter-title {
                font-size: 2rem
            }

            .footer-optimized__newsletter-form {
                flex-direction: column
            }

            .footer-optimized__grid {
                gap: 48px
            }

            .footer-optimized__legal-links {
                gap: 20px
            }
        }
    </style>

    <!-- Background Decorative Elements -->
    <div class="footer-optimized__bg-decor">
        <div class="footer-optimized__bg-circle footer-optimized__bg-circle--top-right"></div>
        <div class="footer-optimized__bg-circle footer-optimized__bg-circle--bottom-left"></div>
    </div>

    <!-- Newsletter Section -->
    <div class="footer-optimized__newsletter">
        <div class="footer-optimized__newsletter-pattern"></div>
        <div class="container">
            <div class="footer-optimized__newsletter-content">
                <div class="footer-optimized__badge">
                    <span class="footer-optimized__badge-text">Offres exclusives</span>
                </div>
                <h3 class="footer-optimized__newsletter-title">Rejoignez la Communauté du Bien-Dormir</h3>
                <p class="footer-optimized__newsletter-desc">Recevez nos offres exclusives, conseils d'experts et les dernières tendances literie directement dans votre boîte mail.</p>
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="footer-optimized__newsletter-form">
                    @csrf
                    <input type="email" name="email" placeholder="Votre adresse email" required class="footer-optimized__newsletter-input" />
                    <button type="submit" class="footer-optimized__newsletter-btn">S'inscrire</button>
                </form>
                @if (session('success'))
                    <div class="footer-optimized__message">{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="footer-optimized__message">{{ $errors->first('email') ?: $errors->first() }}</div>
                @endif
            </div>
        </div>
    </div>

    <!-- Main Footer -->
    <div class="footer-optimized__main">
        <div class="container">
            <div class="footer-optimized__grid">
                <!-- Brand Section -->
                <div>
                    <a href="{{ route('home') }}" class="footer-optimized__brand-logo">
                        <img src="{{ asset('assets/logo/mobile/logo.png') }}" alt="Mobilier Addict" />
                    </a>
                    <p class="footer-optimized__brand-desc">Votre partenaire sommeil depuis 2015. Nous sélectionnons les meilleurs produits pour transformer vos nuits en moments de pur confort.</p>
                    <div class="footer-optimized__social">
                        <a href="#" aria-label="Facebook" class="footer-optimized__social-link">
                            <svg viewBox="0 0 24 24" width="22" height="22"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" stroke="currentColor" stroke-width="2" fill="none"/></svg>
                        </a>
                        <a href="#" aria-label="Instagram" class="footer-optimized__social-link">
                            <svg viewBox="0 0 24 24" width="22" height="22"><rect x="2" y="2" width="20" height="20" rx="5" stroke="currentColor" stroke-width="2" fill="none"/><circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="2" fill="none"/><circle cx="17.5" cy="6.5" r="1.5" fill="currentColor"/></svg>
                        </a>
                        <a href="#" aria-label="WhatsApp" class="footer-optimized__social-link">
                            <svg viewBox="0 0 24 24" width="22" height="22"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" stroke="currentColor" stroke-width="2" fill="none"/></svg>
                        </a>
                        <a href="#" aria-label="YouTube" class="footer-optimized__social-link">
                            <svg viewBox="0 0 24 24" width="22" height="22"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z" stroke="currentColor" stroke-width="2" fill="none"/><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" fill="currentColor"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div>
                    <div class="footer-optimized__section-badge footer-optimized__section-badge--pink">
                        <span class="footer-optimized__section-badge-text">Navigation</span>
                    </div>
                    <h4 class="footer-optimized__section-title">Nos Menus</h4>
                    <div class="footer-optimized__links">
                        <a href="{{ url('/menu') }}" class="footer-optimized__link">
                            <span class="footer-optimized__link-dot footer-optimized__link-dot--pink"></span>
                            Accueil
                        </a>
                        <a href="{{ url('/menu/lit-canape') }}" class="footer-optimized__link">
                            <span class="footer-optimized__link-dot footer-optimized__link-dot--pink"></span>
                            Lit &amp; Canapé
                        </a>
                        <a href="{{ url('/menu/electromenager') }}" class="footer-optimized__link">
                            <span class="footer-optimized__link-dot footer-optimized__link-dot--pink"></span>
                            Électroménager
                        </a>
                        <a href="{{ url('/menu/matelas') }}" class="footer-optimized__link">
                            <span class="footer-optimized__link-dot footer-optimized__link-dot--pink"></span>
                            Matelas
                        </a>
                        <a href="{{ url('/menu/oreillers-et-taies') }}" class="footer-optimized__link">
                            <span class="footer-optimized__link-dot footer-optimized__link-dot--pink"></span>
                            Oreillers et taies
                        </a>
                        <a href="{{ url('/menu/drap-et-couettes') }}" class="footer-optimized__link">
                            <span class="footer-optimized__link-dot footer-optimized__link-dot--pink"></span>
                            Drap et Couettes
                        </a>
                    </div>
                </div>

                <!-- Information Links -->
                <div>
                    <div class="footer-optimized__section-badge footer-optimized__section-badge--blue">
                        <span class="footer-optimized__section-badge-text">Ressources</span>
                    </div>
                    <h4 class="footer-optimized__section-title">Informations</h4>
                    <div class="footer-optimized__links">
                        <a href="{{ route('pages.about') }}" class="footer-optimized__link">
                            <span class="footer-optimized__link-dot footer-optimized__link-dot--blue"></span>
                            À propos de nous
                        </a>
                        <a href="{{ route('pages.contact') }}" class="footer-optimized__link">
                            <span class="footer-optimized__link-dot footer-optimized__link-dot--blue"></span>
                            Contactez-nous
                        </a>
                        <a href="{{ route('pages.customer-service') }}" class="footer-optimized__link">
                            <span class="footer-optimized__link-dot footer-optimized__link-dot--blue"></span>
                            Service client
                        </a>
                        <a href="{{ route('pages.shipping-returns') }}" class="footer-optimized__link">
                            <span class="footer-optimized__link-dot footer-optimized__link-dot--blue"></span>
                            Livraison &amp; Retours
                        </a>
                        <a href="{{ route('pages.faq') }}" class="footer-optimized__link">
                            <span class="footer-optimized__link-dot footer-optimized__link-dot--blue"></span>
                            FAQ
                        </a>
                    </div>
                </div>

                <!-- Contact Section -->
                <div>
                    <div class="footer-optimized__section-badge footer-optimized__section-badge--green">
                        <span class="footer-optimized__section-badge-text">Contact</span>
                    </div>
                    <h4 class="footer-optimized__section-title">Contactez-nous</h4>
                    <div style="display:flex;flex-direction:column;gap:20px">
                        <div class="footer-optimized__contact-item">
                            <span class="footer-optimized__contact-icon footer-optimized__contact-icon--pink">📍</span>
                            <span class="footer-optimized__contact-text">Abidjan, Côte d'Ivoire</span>
                        </div>
                        <div class="footer-optimized__contact-item">
                            <span class="footer-optimized__contact-icon footer-optimized__contact-icon--blue">📞</span>
                            <a href="tel:+2250799140356" class="footer-optimized__contact-link">+225 0799140356</a>
                        </div>
                        <div class="footer-optimized__contact-item">
                            <span class="footer-optimized__contact-icon footer-optimized__contact-icon--green">✉️</span>
                            <a href="mailto:contact@mobilier-addict.com" class="footer-optimized__contact-link">contact@mobilier-addict.com</a>
                        </div>
                        <div class="footer-optimized__contact-item">
                            <span class="footer-optimized__contact-icon footer-optimized__contact-icon--orange">🕐</span>
                            <span class="footer-optimized__contact-text">Lun-Sam: 9h-19h</span>
                        </div>
                    </div>
                    <div style="margin-top:32px">
                        <a href="{{ url('/b2b') }}" class="footer-optimized__b2b-btn">Espace B2B <span style="font-size:1.25rem">→</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Footer -->
    <div class="footer-optimized__bottom">
        <div class="container">
            <div class="footer-optimized__bottom-content">
                <p class="footer-optimized__copyright">© {{ date('Y') }} Mobilier Addict. Tous droits réservés. Design By Ingenieux Digital</p>
                <div class="footer-optimized__legal-links">
                    <a href="{{ route('pages.legal') }}" class="footer-optimized__legal-link">Mentions légales</a>
                    <a href="{{ route('pages.privacy') }}" class="footer-optimized__legal-link">Politique de confidentialité</a>
                    <a href="{{ route('pages.cgv') }}" class="footer-optimized__legal-link">CGV</a>
                </div>
            </div>
        </div>
    </div>
</footer>
