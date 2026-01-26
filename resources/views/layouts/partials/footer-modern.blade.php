{{-- ========================================
     FOOTER MODERNE ET IMPACTANT
     ======================================== --}}
<footer class="modern-footer">
    {{-- Newsletter Section --}}
    <div class="footer-newsletter">
        <div class="container">
            <div class="newsletter-wrapper">
                <div class="newsletter-content">
                    <div class="newsletter-icon">
                        <i class="ti-email"></i>
                    </div>
                    <div class="newsletter-text">
                        <h3>Stay Connected to Ivorian News</h3>
                        <p>Receive the latest news directly in your inbox</p>
                    </div>
                </div>
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="newsletter-form-modern">
                    @csrf
                    <div class="form-group-modern">
                        <input type="email" name="email" placeholder="Your email address" required>
                        <button type="submit">
                            <span>Subscribe</span>
                            <i class="ti-arrow-right"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Main Footer Content --}}
    <div class="footer-main">
        <div class="container">
            <div class="footer-grid">
                {{-- About Section --}}
                <div class="footer-col footer-about">
                    <div class="footer-logo">
                        <img src="{{ asset('assets/imgs/logo/logo.png') }}" alt="InCotedivoire">
                    </div>
                    <p class="footer-description">
                        Your reliable source of information about Côte d'Ivoire. 
                        News, politics, economy, sports and culture.
                    </p>
                    <div class="footer-social">
                        <a href="#" class="social-link facebook" aria-label="Facebook">
                            <i class="ti-facebook"></i>
                        </a>
                        <a href="#" class="social-link twitter" aria-label="Twitter">
                            <i class="ti-twitter-alt"></i>
                        </a>
                        <a href="#" class="social-link instagram" aria-label="Instagram">
                            <i class="ti-instagram"></i>
                        </a>
                        <a href="#" class="social-link linkedin" aria-label="LinkedIn">
                            <i class="ti-linkedin"></i>
                        </a>
                        <a href="#" class="social-link youtube" aria-label="YouTube">
                            <i class="ti-youtube"></i>
                        </a>
                    </div>
                </div>

                {{-- Quick Links --}}
                <div class="footer-col">
                    <h4 class="footer-title">Navigation</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}"><i class="ti-angle-right"></i> Home</a></li>
                        <li><a href="#"><i class="ti-angle-right"></i> About</a></li>
                        <li><a href="#"><i class="ti-angle-right"></i> Team</a></li>
                        <li><a href="#"><i class="ti-angle-right"></i> Contact</a></li>
                        <li><a href="#"><i class="ti-angle-right"></i> Advertise</a></li>
                    </ul>
                </div>

                {{-- Categories --}}
                <div class="footer-col">
                    <h4 class="footer-title">Categories</h4>
                    <ul class="footer-links">
                        <li><a href="#"><i class="ti-angle-right"></i> Politics</a></li>
                        <li><a href="#"><i class="ti-angle-right"></i> Economy</a></li>
                        <li><a href="#"><i class="ti-angle-right"></i> Sports</a></li>
                        <li><a href="#"><i class="ti-angle-right"></i> Culture</a></li>
                        <li><a href="#"><i class="ti-angle-right"></i> International</a></li>
                    </ul>
                </div>

                {{-- Popular Articles --}}
                <div class="footer-col footer-articles">
                    <h4 class="footer-title">Popular Articles</h4>
                    <div class="footer-article-list">
                        @if(isset($popularArticles) && $popularArticles->count() > 0)
                            @foreach($popularArticles->take(3) as $article)
                            <div class="footer-article-item">
                                <div class="article-thumb">
                                    <img src="{{ $article->image ? asset('storage/' . $article->image) : asset('assets/imgs/news-default.jpg') }}" alt="{{ $article->title }}">
                                </div>
                                <div class="article-info">
                                    <h5><a href="{{ route('articles.show', $article->slug) }}">{{ Str::limit($article->title, 50) }}</a></h5>
                                    <span class="article-date"><i class="ti-time"></i> {{ $article->published_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <p class="text-muted">No popular articles</p>
                        @endif
                    </div>
                </div>

                {{-- Contact Info --}}
                <div class="footer-col">
                    <h4 class="footer-title">Contact</h4>
                    <ul class="footer-contact">
                        <li>
                            <i class="ti-location-pin"></i>
                            <span>Abidjan, Côte d'Ivoire</span>
                        </li>
                        <li>
                            <i class="ti-email"></i>
                            <a href="mailto:contact@incotedivoire.net">contact@incotedivoire.net</a>
                        </li>
                        <li>
                            <i class="ti-mobile"></i>
                            <a href="tel:+2250000000000">+225 00 00 00 00 00</a>
                        </li>
                        <li>
                            <i class="ti-world"></i>
                            <a href="https://incotedivoire.net" target="_blank">www.incotedivoire.net</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer Bottom --}}
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-content">
                <div class="copyright">
                    <p>© {{ date('Y') }} <strong>InCotedivoire</strong> | All rights reserved | Design by <a href="https://bilebossombra.com" target="_blank">Bilé Bossombra</a></p>
                </div>
                <div class="footer-bottom-links">
                    <a href="#">Terms of Use</a>
                    <span class="separator">|</span>
                    <a href="#">Privacy Policy</a>
                    <span class="separator">|</span>
                    <a href="#">Contact</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Back to Top Button --}}
    <button class="back-to-top" id="backToTop" aria-label="Back to top">
        <i class="ti-arrow-up"></i>
    </button>
</footer>

{{-- Back to Top Script --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const backToTop = document.getElementById('backToTop');
    
    // Show/hide button on scroll
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTop.classList.add('show');
        } else {
            backToTop.classList.remove('show');
        }
    });
    
    // Scroll to top on click
    backToTop.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});
</script>
