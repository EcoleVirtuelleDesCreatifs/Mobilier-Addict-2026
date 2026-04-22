<footer class="footer-new" style="background:#0f172a;color:#fff">
    <!-- Newsletter Section -->
    <div style="background:linear-gradient(135deg,#ec4899,#be185d);padding:60px 0">
        <div class="container" style="max-width:1200px;margin:0 auto;padding:0 20px">
            <div style="text-align:center;max-width:600px;margin:0 auto">
                <h3 style="font-size:2rem;font-weight:900;margin:0 0 16px;color:#fff">Rejoignez la Communauté du Bien-Dormir</h3>
                <p style="font-size:1.125rem;color:rgba(255,255,255,.9);margin:0 0 32px">Recevez nos offres exclusives, conseils d'experts et les dernières tendances literie.</p>
                <form action="{{ route('newsletter.subscribe') }}" method="POST" style="display:flex;gap:12px;max-width:500px;margin:0 auto">
                    @csrf
                    <input type="email" name="email" placeholder="Votre adresse email" required style="flex:1;padding:16px 24px;border-radius:12px;border:0;font-size:1rem;outline:none" />
                    <button type="submit" style="background:#0f172a;color:#fff;padding:16px 32px;border-radius:12px;border:0;font-weight:700;font-size:1rem;cursor:pointer;transition:all .3s ease">S'inscrire</button>
                </form>
                @if (session('success'))
                    <div style="margin-top:16px;color:#fff;font-size:0.95rem">{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div style="margin-top:16px;color:#fff;font-size:0.95rem">{{ $errors->first('email') ?: $errors->first() }}</div>
                @endif
            </div>
        </div>
    </div>

    <!-- Main Footer -->
    <div style="padding:80px 0">
        <div class="container" style="max-width:1200px;margin:0 auto;padding:0 20px">
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:48px">
                <!-- Brand Section -->
                <div>
                    <a href="{{ route('home') }}" style="display:inline-block;margin-bottom:24px">
                        <img src="{{ asset('assets/logo/mobile/logo.png') }}" alt="Mobilier Addict" style="height:48px" />
                    </a>
                    <p style="color:rgba(255,255,255,.7);font-size:1rem;line-height:1.6;margin:0 0 24px">Votre partenaire sommeil depuis 2015. Nous sélectionnons les meilleurs produits pour transformer vos nuits.</p>
                    <div style="display:flex;gap:16px">
                        <a href="#" aria-label="Facebook" style="width:44px;height:44px;background:rgba(255,255,255,.1);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;transition:all .3s ease"><svg viewBox="0 0 24 24" width="20" height="20"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" stroke="currentColor" stroke-width="2" fill="none"/></svg></a>
                        <a href="#" aria-label="Instagram" style="width:44px;height:44px;background:rgba(255,255,255,.1);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;transition:all .3s ease"><svg viewBox="0 0 24 24" width="20" height="20"><rect x="2" y="2" width="20" height="20" rx="5" stroke="currentColor" stroke-width="2" fill="none"/><circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="2" fill="none"/><circle cx="17.5" cy="6.5" r="1.5" fill="currentColor"/></svg></a>
                        <a href="#" aria-label="WhatsApp" style="width:44px;height:44px;background:rgba(255,255,255,.1);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;transition:all .3s ease"><svg viewBox="0 0 24 24" width="20" height="20"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" stroke="currentColor" stroke-width="2" fill="none"/></svg></a>
                        <a href="#" aria-label="YouTube" style="width:44px;height:44px;background:rgba(255,255,255,.1);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;transition:all .3s ease"><svg viewBox="0 0 24 24" width="20" height="20"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z" stroke="currentColor" stroke-width="2" fill="none"/><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" fill="currentColor"/></svg></a>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div>
                    <h4 style="font-size:1.125rem;font-weight:700;margin:0 0 24px;color:#fff">Nos Menus</h4>
                    <div style="display:flex;flex-direction:column;gap:12px">
                        <a href="{{ url('/menu') }}" style="color:rgba(255,255,255,.7);text-decoration:none;font-size:0.9375rem;transition:color .3s ease">Accueil</a>
                        <a href="{{ url('/menu/lit-canape') }}" style="color:rgba(255,255,255,.7);text-decoration:none;font-size:0.9375rem;transition:color .3s ease">Lit &amp; Canapé</a>
                        <a href="{{ url('/menu/electromenager') }}" style="color:rgba(255,255,255,.7);text-decoration:none;font-size:0.9375rem;transition:color .3s ease">Électroménager</a>
                        <a href="{{ url('/menu/matelas') }}" style="color:rgba(255,255,255,.7);text-decoration:none;font-size:0.9375rem;transition:color .3s ease">Matelas</a>
                        <a href="{{ url('/menu/oreillers-et-taies') }}" style="color:rgba(255,255,255,.7);text-decoration:none;font-size:0.9375rem;transition:color .3s ease">Oreillers et taies</a>
                        <a href="{{ url('/menu/drap-et-couettes') }}" style="color:rgba(255,255,255,.7);text-decoration:none;font-size:0.9375rem;transition:color .3s ease">Drap et Couettes</a>
                    </div>
                </div>

                <!-- Information Links -->
                <div>
                    <h4 style="font-size:1.125rem;font-weight:700;margin:0 0 24px;color:#fff">Informations</h4>
                    <div style="display:flex;flex-direction:column;gap:12px">
                        <a href="{{ route('pages.about') }}" style="color:rgba(255,255,255,.7);text-decoration:none;font-size:0.9375rem;transition:color .3s ease">À propos de nous</a>
                        <a href="{{ route('pages.contact') }}" style="color:rgba(255,255,255,.7);text-decoration:none;font-size:0.9375rem;transition:color .3s ease">Contactez-nous</a>
                        <a href="{{ route('pages.customer-service') }}" style="color:rgba(255,255,255,.7);text-decoration:none;font-size:0.9375rem;transition:color .3s ease">Service client</a>
                        <a href="{{ route('pages.shipping-returns') }}" style="color:rgba(255,255,255,.7);text-decoration:none;font-size:0.9375rem;transition:color .3s ease">Livraison &amp; Retours</a>
                        <a href="{{ route('pages.faq') }}" style="color:rgba(255,255,255,.7);text-decoration:none;font-size:0.9375rem;transition:color .3s ease">FAQ</a>
                    </div>
                </div>

                <!-- Contact Section -->
                <div>
                    <h4 style="font-size:1.125rem;font-weight:700;margin:0 0 24px;color:#fff">Contact</h4>
                    <div style="display:flex;flex-direction:column;gap:16px">
                        <div style="display:flex;align-items:center;gap:12px">
                            <span style="width:40px;height:40px;background:rgba(236,72,153,.15);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.25rem">📍</span>
                            <span style="color:rgba(255,255,255,.7);font-size:0.9375rem">Abidjan, Côte d'Ivoire</span>
                        </div>
                        <div style="display:flex;align-items:center;gap:12px">
                            <span style="width:40px;height:40px;background:rgba(236,72,153,.15);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.25rem">📞</span>
                            <a href="tel:+2250799140356" style="color:rgba(255,255,255,.7);text-decoration:none;font-size:0.9375rem">+225 0799140356</a>
                        </div>
                        <div style="display:flex;align-items:center;gap:12px">
                            <span style="width:40px;height:40px;background:rgba(236,72,153,.15);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.25rem">✉️</span>
                            <a href="mailto:contact@mobilier-addict.com" style="color:rgba(255,255,255,.7);text-decoration:none;font-size:0.9375rem">contact@mobilier-addict.com</a>
                        </div>
                        <div style="display:flex;align-items:center;gap:12px">
                            <span style="width:40px;height:40px;background:rgba(236,72,153,.15);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.25rem">🕐</span>
                            <span style="color:rgba(255,255,255,.7);font-size:0.9375rem">Lun-Sam: 9h-19h</span>
                        </div>
                    </div>
                    <div style="margin-top:24px">
                        <a href="{{ url('/b2b') }}" style="display:inline-flex;align-items:center;gap:8px;background:#3b82f6;color:#fff;padding:12px 24px;border-radius:12px;text-decoration:none;font-weight:700;font-size:0.9375rem;transition:all .3s ease">Espace B2B <span>→</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Footer -->
    <div style="background:rgba(0,0,0,.3);padding:24px 0">
        <div class="container" style="max-width:1200px;margin:0 auto;padding:0 20px">
            <div style="display:flex;flex-direction:column;gap:16px;align-items:center">
                <p style="color:rgba(255,255,255,.6);font-size:0.875rem;margin:0">© {{ date('Y') }} Mobilier Addict. Tous droits réservés.</p>
                <div style="display:flex;gap:24px;flex-wrap:wrap;justify-content:center">
                    <a href="{{ route('pages.legal') }}" style="color:rgba(255,255,255,.6);text-decoration:none;font-size:0.875rem;transition:color .3s ease">Mentions légales</a>
                    <a href="{{ route('pages.privacy') }}" style="color:rgba(255,255,255,.6);text-decoration:none;font-size:0.875rem;transition:color .3s ease">Politique de confidentialité</a>
                    <a href="{{ route('pages.cgv') }}" style="color:rgba(255,255,255,.6);text-decoration:none;font-size:0.875rem;transition:color .3s ease">CGV</a>
                </div>
            </div>
        </div>
    </div>
</footer>
