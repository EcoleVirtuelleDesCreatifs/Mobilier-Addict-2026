<footer class="footer-new" style="background:linear-gradient(180deg,#0f172a 0%,#1e293b 100%);color:#fff;position:relative;overflow:hidden">
    <!-- Background Decorative Elements -->
    <div style="position:absolute;top:0;left:0;width:100%;height:100%;pointer-events:none">
        <div style="position:absolute;top:-100px;right:-100px;width:400px;height:400px;background:radial-gradient(circle,rgba(236,72,153,.15) 0%,transparent 70%);border-radius:50%"></div>
        <div style="position:absolute;bottom:-100px;left:-100px;width:400px;height:400px;background:radial-gradient(circle,rgba(59,130,246,.15) 0%,transparent 70%);border-radius:50%"></div>
    </div>

    <!-- Newsletter Section -->
    <div style="background:linear-gradient(135deg,#ec4899 0%,#be185d 100%);padding:80px 0;position:relative">
        <div style="position:absolute;top:0;left:0;width:100%;height:100%;background:url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><circle cx=%2250%22 cy=%2250%22 r=%221%22 fill=%22rgba(255,255,255,.1)%22/></svg>');background-size:20px 20px;opacity:.5"></div>
        <div class="container" style="max-width:1200px;margin:0 auto;padding:0 20px;position:relative">
            <div style="text-align:center;max-width:700px;margin:0 auto">
                <div style="display:inline-block;padding:8px 20px;background:rgba(255,255,255,.2);border-radius:50px;margin-bottom:24px">
                    <span style="color:#fff;font-size:0.875rem;font-weight:600;letter-spacing:2px;text-transform:uppercase">Offres exclusives</span>
                </div>
                <h3 style="font-size:3rem;font-weight:900;margin:0 0 20px;color:#fff;letter-spacing:-.02em;line-height:1.1">Rejoignez la Communauté du Bien-Dormir</h3>
                <p style="font-size:1.25rem;color:rgba(255,255,255,.95);margin:0 0 40px;line-height:1.6">Recevez nos offres exclusives, conseils d'experts et les dernières tendances literie directement dans votre boîte mail.</p>
                <form action="{{ route('newsletter.subscribe') }}" method="POST" style="display:flex;gap:16px;max-width:550px;margin:0 auto">
                    @csrf
                    <input type="email" name="email" placeholder="Votre adresse email" required style="flex:1;padding:20px 28px;border-radius:16px;border:0;font-size:1.0625rem;outline:none;box-shadow:0 10px 40px rgba(0,0,0,.2)" />
                    <button type="submit" style="background:#0f172a;color:#fff;padding:20px 40px;border-radius:16px;border:0;font-weight:800;font-size:1.0625rem;cursor:pointer;transition:all .3s ease;box-shadow:0 10px 40px rgba(0,0,0,.3);text-transform:uppercase;letter-spacing:1px">S'inscrire</button>
                </form>
                @if (session('success'))
                    <div style="margin-top:20px;color:#fff;font-size:1rem;background:rgba(255,255,255,.2);padding:12px 24px;border-radius:12px;display:inline-block">{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div style="margin-top:20px;color:#fff;font-size:1rem;background:rgba(255,255,255,.2);padding:12px 24px;border-radius:12px;display:inline-block">{{ $errors->first('email') ?: $errors->first() }}</div>
                @endif
            </div>
        </div>
    </div>

    <!-- Main Footer -->
    <div style="padding:100px 0;position:relative">
        <div class="container" style="max-width:1200px;margin:0 auto;padding:0 20px">
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:64px">
                <!-- Brand Section -->
                <div>
                    <a href="{{ route('home') }}" style="display:inline-block;margin-bottom:32px">
                        <img src="{{ asset('assets/logo/mobile/logo.png') }}" alt="Mobilier Addict" style="height:56px" />
                    </a>
                    <p style="color:rgba(255,255,255,.8);font-size:1.0625rem;line-height:1.7;margin:0 0 32px;letter-spacing:-.01em">Votre partenaire sommeil depuis 2015. Nous sélectionnons les meilleurs produits pour transformer vos nuits en moments de pur confort.</p>
                    <div style="display:flex;gap:16px">
                        <a href="#" aria-label="Facebook" style="width:52px;height:52px;background:rgba(255,255,255,.1);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;transition:all .3s ease;border:1px solid rgba(255,255,255,.1)"><svg viewBox="0 0 24 24" width="22" height="22"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" stroke="currentColor" stroke-width="2" fill="none"/></svg></a>
                        <a href="#" aria-label="Instagram" style="width:52px;height:52px;background:rgba(255,255,255,.1);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;transition:all .3s ease;border:1px solid rgba(255,255,255,.1)"><svg viewBox="0 0 24 24" width="22" height="22"><rect x="2" y="2" width="20" height="20" rx="5" stroke="currentColor" stroke-width="2" fill="none"/><circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="2" fill="none"/><circle cx="17.5" cy="6.5" r="1.5" fill="currentColor"/></svg></a>
                        <a href="#" aria-label="WhatsApp" style="width:52px;height:52px;background:rgba(255,255,255,.1);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;transition:all .3s ease;border:1px solid rgba(255,255,255,.1)"><svg viewBox="0 0 24 24" width="22" height="22"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" stroke="currentColor" stroke-width="2" fill="none"/></svg></a>
                        <a href="#" aria-label="YouTube" style="width:52px;height:52px;background:rgba(255,255,255,.1);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;transition:all .3s ease;border:1px solid rgba(255,255,255,.1)"><svg viewBox="0 0 24 24" width="22" height="22"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z" stroke="currentColor" stroke-width="2" fill="none"/><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" fill="currentColor"/></svg></a>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div>
                    <div style="display:inline-block;padding:8px 16px;background:rgba(236,72,153,.15);border-radius:50px;margin-bottom:24px;border:1px solid rgba(236,72,153,.3)">
                        <span style="color:#ec4899;font-size:0.75rem;font-weight:700;letter-spacing:2px;text-transform:uppercase">Navigation</span>
                    </div>
                    <h4 style="font-size:1.5rem;font-weight:800;margin:0 0 28px;color:#fff;letter-spacing:-.01em">Nos Menus</h4>
                    <div style="display:flex;flex-direction:column;gap:16px">
                        <a href="{{ url('/menu') }}" style="color:rgba(255,255,255,.8);text-decoration:none;font-size:1rem;transition:all .3s ease;display:flex;align-items:center;gap:12px">
                            <span style="width:8px;height:8px;background:#ec4899;border-radius:50%"></span>
                            Accueil
                        </a>
                        <a href="{{ url('/menu/lit-canape') }}" style="color:rgba(255,255,255,.8);text-decoration:none;font-size:1rem;transition:all .3s ease;display:flex;align-items:center;gap:12px">
                            <span style="width:8px;height:8px;background:#ec4899;border-radius:50%"></span>
                            Lit &amp; Canapé
                        </a>
                        <a href="{{ url('/menu/electromenager') }}" style="color:rgba(255,255,255,.8);text-decoration:none;font-size:1rem;transition:all .3s ease;display:flex;align-items:center;gap:12px">
                            <span style="width:8px;height:8px;background:#ec4899;border-radius:50%"></span>
                            Électroménager
                        </a>
                        <a href="{{ url('/menu/matelas') }}" style="color:rgba(255,255,255,.8);text-decoration:none;font-size:1rem;transition:all .3s ease;display:flex;align-items:center;gap:12px">
                            <span style="width:8px;height:8px;background:#ec4899;border-radius:50%"></span>
                            Matelas
                        </a>
                        <a href="{{ url('/menu/oreillers-et-taies') }}" style="color:rgba(255,255,255,.8);text-decoration:none;font-size:1rem;transition:all .3s ease;display:flex;align-items:center;gap:12px">
                            <span style="width:8px;height:8px;background:#ec4899;border-radius:50%"></span>
                            Oreillers et taies
                        </a>
                        <a href="{{ url('/menu/drap-et-couettes') }}" style="color:rgba(255,255,255,.8);text-decoration:none;font-size:1rem;transition:all .3s ease;display:flex;align-items:center;gap:12px">
                            <span style="width:8px;height:8px;background:#ec4899;border-radius:50%"></span>
                            Drap et Couettes
                        </a>
                    </div>
                </div>

                <!-- Information Links -->
                <div>
                    <div style="display:inline-block;padding:8px 16px;background:rgba(59,130,246,.15);border-radius:50px;margin-bottom:24px;border:1px solid rgba(59,130,246,.3)">
                        <span style="color:#3b82f6;font-size:0.75rem;font-weight:700;letter-spacing:2px;text-transform:uppercase">Ressources</span>
                    </div>
                    <h4 style="font-size:1.5rem;font-weight:800;margin:0 0 28px;color:#fff;letter-spacing:-.01em">Informations</h4>
                    <div style="display:flex;flex-direction:column;gap:16px">
                        <a href="{{ route('pages.about') }}" style="color:rgba(255,255,255,.8);text-decoration:none;font-size:1rem;transition:all .3s ease;display:flex;align-items:center;gap:12px">
                            <span style="width:8px;height:8px;background:#3b82f6;border-radius:50%"></span>
                            À propos de nous
                        </a>
                        <a href="{{ route('pages.contact') }}" style="color:rgba(255,255,255,.8);text-decoration:none;font-size:1rem;transition:all .3s ease;display:flex;align-items:center;gap:12px">
                            <span style="width:8px;height:8px;background:#3b82f6;border-radius:50%"></span>
                            Contactez-nous
                        </a>
                        <a href="{{ route('pages.customer-service') }}" style="color:rgba(255,255,255,.8);text-decoration:none;font-size:1rem;transition:all .3s ease;display:flex;align-items:center;gap:12px">
                            <span style="width:8px;height:8px;background:#3b82f6;border-radius:50%"></span>
                            Service client
                        </a>
                        <a href="{{ route('pages.shipping-returns') }}" style="color:rgba(255,255,255,.8);text-decoration:none;font-size:1rem;transition:all .3s ease;display:flex;align-items:center;gap:12px">
                            <span style="width:8px;height:8px;background:#3b82f6;border-radius:50%"></span>
                            Livraison &amp; Retours
                        </a>
                        <a href="{{ route('pages.faq') }}" style="color:rgba(255,255,255,.8);text-decoration:none;font-size:1rem;transition:all .3s ease;display:flex;align-items:center;gap:12px">
                            <span style="width:8px;height:8px;background:#3b82f6;border-radius:50%"></span>
                            FAQ
                        </a>
                    </div>
                </div>

                <!-- Contact Section -->
                <div>
                    <div style="display:inline-block;padding:8px 16px;background:rgba(16,185,129,.15);border-radius:50px;margin-bottom:24px;border:1px solid rgba(16,185,129,.3)">
                        <span style="color:#10b981;font-size:0.75rem;font-weight:700;letter-spacing:2px;text-transform:uppercase">Contact</span>
                    </div>
                    <h4 style="font-size:1.5rem;font-weight:800;margin:0 0 28px;color:#fff;letter-spacing:-.01em">Contactez-nous</h4>
                    <div style="display:flex;flex-direction:column;gap:20px">
                        <div style="display:flex;align-items:center;gap:16px;padding:16px;background:rgba(255,255,255,.05);border-radius:16px;border:1px solid rgba(255,255,255,.1);transition:all .3s ease">
                            <span style="width:48px;height:48px;background:linear-gradient(135deg,#ec4899,#be185d);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.5rem">📍</span>
                            <span style="color:rgba(255,255,255,.9);font-size:1rem;font-weight:500">Abidjan, Côte d'Ivoire</span>
                        </div>
                        <div style="display:flex;align-items:center;gap:16px;padding:16px;background:rgba(255,255,255,.05);border-radius:16px;border:1px solid rgba(255,255,255,.1);transition:all .3s ease">
                            <span style="width:48px;height:48px;background:linear-gradient(135deg,#3b82f6,#2563eb);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.5rem">📞</span>
                            <a href="tel:+2250799140356" style="color:rgba(255,255,255,.9);text-decoration:none;font-size:1rem;font-weight:500">+225 0799140356</a>
                        </div>
                        <div style="display:flex;align-items:center;gap:16px;padding:16px;background:rgba(255,255,255,.05);border-radius:16px;border:1px solid rgba(255,255,255,.1);transition:all .3s ease">
                            <span style="width:48px;height:48px;background:linear-gradient(135deg,#10b981,#059669);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.5rem">✉️</span>
                            <a href="mailto:contact@mobilier-addict.com" style="color:rgba(255,255,255,.9);text-decoration:none;font-size:1rem;font-weight:500">contact@mobilier-addict.com</a>
                        </div>
                        <div style="display:flex;align-items:center;gap:16px;padding:16px;background:rgba(255,255,255,.05);border-radius:16px;border:1px solid rgba(255,255,255,.1);transition:all .3s ease">
                            <span style="width:48px;height:48px;background:linear-gradient(135deg,#f59e0b,#d97706);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.5rem">🕐</span>
                            <span style="color:rgba(255,255,255,.9);font-size:1rem;font-weight:500">Lun-Sam: 9h-19h</span>
                        </div>
                    </div>
                    <div style="margin-top:32px">
                        <a href="{{ url('/b2b') }}" style="display:inline-flex;align-items:center;gap:12px;background:linear-gradient(135deg,#3b82f6,#2563eb);color:#fff;padding:16px 32px;border-radius:16px;text-decoration:none;font-weight:800;font-size:1rem;transition:all .3s ease;box-shadow:0 10px 30px rgba(59,130,246,.3);text-transform:uppercase;letter-spacing:1px">Espace B2B <span style="font-size:1.25rem">→</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Footer -->
    <div style="background:rgba(0,0,0,.4);padding:32px 0;position:relative">
        <div class="container" style="max-width:1200px;margin:0 auto;padding:0 20px">
            <div style="display:flex;flex-direction:column;gap:20px;align-items:center">
                <p style="color:rgba(255,255,255,.7);font-size:0.9375rem;margin:0;letter-spacing:-.01em">© {{ date('Y') }} Mobilier Addict. Tous droits réservés. Crafted with ❤️ in Côte d'Ivoire</p>
                <div style="display:flex;gap:32px;flex-wrap:wrap;justify-content:center">
                    <a href="{{ route('pages.legal') }}" style="color:rgba(255,255,255,.7);text-decoration:none;font-size:0.875rem;transition:color .3s ease;position:relative">Mentions légales</a>
                    <a href="{{ route('pages.privacy') }}" style="color:rgba(255,255,255,.7);text-decoration:none;font-size:0.875rem;transition:color .3s ease;position:relative">Politique de confidentialité</a>
                    <a href="{{ route('pages.cgv') }}" style="color:rgba(255,255,255,.7);text-decoration:none;font-size:0.875rem;transition:color .3s ease;position:relative">CGV</a>
                </div>
            </div>
        </div>
    </div>
</footer>
