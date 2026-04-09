<section class="home-explore-categories" aria-label="Explorez nos catégories">
    <div class="container">
        <div class="home-explore-categories__head">
            <h2 class="home-explore-categories__title">Meilleures Catégories</h2>
            <p class="home-explore-categories__subtitle">Matelas, Oreillers, Couettes, Électroménagers, Lit et Canapé</p>
        </div>

        <div class="home-explore-categories__grid">
            <a class="home-explore-categories__card" href="{{ route('menu.show', 'matelas') }}">
                <img class="home-explore-categories__img" src="{{ asset('uploads/categories/1770082100_dEWmOT9kVr.png') }}" alt="Matelas" loading="lazy" />
                <div class="home-explore-categories__overlay">
                    <h3 class="home-explore-categories__name">Matelas</h3>
                    <span class="home-explore-categories__cta">Découvrir <span aria-hidden="true">→</span></span>
                </div>
            </a>

            <a class="home-explore-categories__card" href="{{ route('menu.show', 'lit-canape') }}">
                <img class="home-explore-categories__img" src="{{ asset('uploads/categories/1769652855_0ek5yI7qIP.jpg') }}" alt="Lits" loading="lazy" />
                <div class="home-explore-categories__overlay">
                    <h3 class="home-explore-categories__name">Lits &amp; Canapés</h3>
                    <span class="home-explore-categories__cta">Découvrir <span aria-hidden="true">→</span></span>
                </div>
            </a>

            <a class="home-explore-categories__card" href="{{ route('menu.show', 'electromenager') }}">
                <img class="home-explore-categories__img" src="{{ asset('uploads/categories/1770082284_Q4JZAWEiTM.png') }}" alt="Electroménagers" loading="lazy" />
                <div class="home-explore-categories__overlay">
                    <h3 class="home-explore-categories__name">Electroménagers</h3>
                    <span class="home-explore-categories__cta">Découvrir <span aria-hidden="true">→</span></span>
                </div>
            </a>

            <a class="home-explore-categories__card" href="{{ route('menu.show', 'drap-et-couettes') }}">
                <img class="home-explore-categories__img" src="{{ asset('uploads/categories/1769653102_3iqxe6P6yu.jpg') }}" alt="Couettes" loading="lazy" />
                <div class="home-explore-categories__overlay">
                    <h3 class="home-explore-categories__name">Couettes</h3>
                    <span class="home-explore-categories__cta">Découvrir <span aria-hidden="true">→</span></span>
                </div>
            </a>
        </div>
    </div>
</section>
