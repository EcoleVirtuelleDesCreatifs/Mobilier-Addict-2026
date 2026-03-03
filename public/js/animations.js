// Smooth scroll animations on page load and scroll
document.addEventListener('DOMContentLoaded', function() {

  const reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  if (reduceMotion) {
    document.querySelectorAll('section, .product-card, .cat-card, .guarantee, .article-card, .acc-card, .fav-card, .space-card, .brand-logo').forEach(el => {
      el.classList.add('reveal');
      el.classList.add('is-visible');
    });
  }

  // Hamburger menu toggle
  const hamburger = document.getElementById('hamburger');
  const nav = document.querySelector('.header-new__nav');
  const navClose = document.getElementById('nav-close');

  const closeMenu = () => {
    hamburger.classList.remove('active');
    nav.classList.remove('active');
    document.body.style.overflow = '';
    hamburger.setAttribute('aria-expanded', 'false');

    document.querySelectorAll('[data-submenu].is-open').forEach((el) => {
      el.classList.remove('is-open');
      const trigger = el.querySelector('[data-submenu-trigger]');
      if (trigger) trigger.setAttribute('aria-expanded', 'false');

      const link = el.querySelector('.nav-link');
      if (link) link.setAttribute('aria-expanded', 'false');
    });
  };

  const openMenu = () => {
    hamburger.classList.add('active');
    nav.classList.add('active');
    document.body.style.overflow = 'hidden';
    hamburger.setAttribute('aria-expanded', 'true');
  };

  if (hamburger && nav) {
    hamburger.addEventListener('click', () => {
      if (nav.classList.contains('active')) {
        closeMenu();
      } else {
        openMenu();
      }
    });

    const isMobileNav = () => window.matchMedia && window.matchMedia('(max-width: 767px)').matches;
    document.querySelectorAll('[data-submenu]').forEach((item) => {
      const trigger = item.querySelector('[data-submenu-trigger]');
      if (!trigger) return;

      trigger.addEventListener('click', (e) => {
        if (!isMobileNav()) return;
        e.preventDefault();
        const isOpen = item.classList.toggle('is-open');
        trigger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');

        const link = item.querySelector('.nav-link');
        if (link) link.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
      });
    });

    // Close button
    if (navClose) {
      navClose.addEventListener('click', closeMenu);
    }

    // Close menu when clicking a link
    nav.querySelectorAll('.nav-link').forEach(link => {
      link.addEventListener('click', (e) => {
        if (isMobileNav() && link.closest('[data-submenu]') && link.closest('[data-submenu]').querySelector('[data-submenu-trigger]')) {
          return;
        }
        closeMenu();
      });
    });

    // Close on escape key
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && nav.classList.contains('active')) {
        closeMenu();
      }
    });
  }

  // Elements to animate on scroll
  if (!reduceMotion) {
    const observerOptions = {
      root: null,
      rootMargin: '0px 0px -5% 0px',
      threshold: 0.12
    };

    const STAGGER_CONTAINER_SELECTORS = [
      '.categories__grid',
      '.best-modern__grid',
      '.favorites__grid',
      '.collection__grid',
      '.electro__grid',
      '.inspire__grid',
      '.spaces__grid',
      '.brands__grid',
      '.blog-new__grid',
      '.articles__grid',
    ];

    const STAGGER_ITEM_SELECTORS = [
      '.product-card',
      '.cat-card',
      '.fav-card',
      '.acc-card',
      '.space-card',
      '.brand-logo',
      '.article-card',
      '.collection-card',
      '.electro-card',
      '.inspire__card',
    ];

    const isStaggerContainer = (el) => {
      return STAGGER_CONTAINER_SELECTORS.some((sel) => el.matches(sel));
    };

    const assignStaggerDelays = (container) => {
      const items = Array.from(container.querySelectorAll(STAGGER_ITEM_SELECTORS.join(',')));
      if (!items.length) return;
      const base = 40;
      const step = 70;
      items.forEach((item, i) => {
        item.style.setProperty('--reveal-delay', `${base + i * step}ms`);
      });
    };

    document.querySelectorAll(STAGGER_CONTAINER_SELECTORS.join(','))
      .forEach(assignStaggerDelays);

    const animateOnScroll = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');

          const children = entry.target.querySelectorAll('.stagger-child');
          children.forEach((child, index) => {
            child.style.setProperty('--reveal-delay', `${index * 80}ms`);
            child.classList.add('is-visible');
          });

          animateOnScroll.unobserve(entry.target);
        }
      });
    }, observerOptions);

    document.querySelectorAll('section, .product-card, .cat-card, .guarantee, .article-card, .acc-card, .fav-card, .space-card, .brand-logo').forEach(el => {
      el.classList.add('reveal');
      animateOnScroll.observe(el);
    });
  }

  // Parallax effect on hero
  const hero = document.querySelector('.hero__bg img');
  if (hero && !reduceMotion) {
    let ticking = false;
    const onHeroScroll = () => {
      if (ticking) return;
      ticking = true;
      window.requestAnimationFrame(() => {
        const scrolled = window.pageYOffset || 0;
        hero.style.transform = `translate3d(0,${scrolled * 0.18}px,0) scale(1.08)`;
        ticking = false;
      });
    };

    window.addEventListener('scroll', onHeroScroll, { passive: true });
    onHeroScroll();
  }

  // Smooth counter animation for stats
  const animateCounter = (el) => {
    const target = parseInt(el.textContent.replace(/\D/g, ''));
    const suffix = el.textContent.replace(/[\d.]/g, '');
    let current = 0;
    const increment = target / 50;
    const timer = setInterval(() => {
      current += increment;
      if (current >= target) {
        el.textContent = target + suffix;
        clearInterval(timer);
      } else {
        el.textContent = Math.floor(current) + suffix;
      }
    }, 30);
  };

  // Observe stat numbers
  const statsObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
        entry.target.classList.add('counted');
        animateCounter(entry.target);
      }
    });
  }, { threshold: 0.5 });

  document.querySelectorAll('.hero__stat-number').forEach(stat => {
    statsObserver.observe(stat);
  });

  // Add hover ripple effect to buttons
  document.querySelectorAll('.hero__btn, .articles__btn, .searchbar__btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
      const ripple = document.createElement('span');
      ripple.classList.add('ripple');
      this.appendChild(ripple);

      const rect = this.getBoundingClientRect();
      ripple.style.left = `${e.clientX - rect.left}px`;
      ripple.style.top = `${e.clientY - rect.top}px`;

      setTimeout(() => ripple.remove(), 600);
    });
  });

  // Searchbar autocomplete
  const searchbar = document.querySelector('[data-searchbar]');
  if (searchbar) {
    const input = searchbar.querySelector('[data-search-input]');
    const suggest = searchbar.querySelector('[data-search-suggest]');
    const clearBtn = searchbar.querySelector('[data-search-clear]');
    let abortController = null;
    let debounceTimer = null;
    let activeIndex = -1;
    let items = [];

    const closeSuggest = () => {
      searchbar.classList.remove('is-open');
      activeIndex = -1;
      items = [];
      if (suggest) suggest.innerHTML = '';
    };

    const openSuggest = () => {
      if (!items.length) return;
      searchbar.classList.add('is-open');
    };

    const setActiveItem = (idx) => {
      activeIndex = idx;
      if (!suggest) return;
      Array.from(suggest.querySelectorAll('.searchbar__suggest-item')).forEach((el, i) => {
        el.classList.toggle('is-active', i === activeIndex);
      });
    };

    const render = (data) => {
      items = Array.isArray(data) ? data : [];
      if (!suggest) return;

      if (!items.length) {
        closeSuggest();
        return;
      }

      const html = items.map((p, i) => {
        const img = p.image ? p.image : '';
        const href = p.slug ? `/produit/${encodeURIComponent(p.slug)}` : '#';
        const price = p.price ? p.price : '';

        return `\
<a class="searchbar__suggest-item" role="option" aria-selected="false" data-index="${i}" href="${href}">\
  <span class="searchbar__suggest-thumb">\
    ${img ? `<img src="${img}" alt="" loading="lazy" />` : ''}\
  </span>\
  <span class="searchbar__suggest-meta">\
    <span class="searchbar__suggest-name">${p.name || ''}</span>\
    <span class="searchbar__suggest-price">${price}</span>\
  </span>\
</a>`;
      }).join('');

      suggest.innerHTML = html;
      openSuggest();
      setActiveItem(-1);

      suggest.querySelectorAll('.searchbar__suggest-item').forEach((el) => {
        el.addEventListener('mouseenter', () => {
          const i = Number(el.getAttribute('data-index'));
          if (!Number.isNaN(i)) setActiveItem(i);
        });
      });
    };

    const fetchSuggest = (q) => {
      if (!suggest) return;
      if (abortController) abortController.abort();
      abortController = new AbortController();

      fetch(`/search/suggest?q=${encodeURIComponent(q)}`, {
        headers: { 'Accept': 'application/json' },
        signal: abortController.signal,
      })
        .then((r) => (r.ok ? r.json() : []))
        .then((data) => render(data))
        .catch((err) => {
          if (err && err.name === 'AbortError') return;
          closeSuggest();
        });
    };

    const onInput = () => {
      const q = (input && input.value ? input.value : '').trim();

      if (clearBtn) {
        if (q.length) searchbar.classList.add('is-open');
        else searchbar.classList.remove('is-open');
      }

      if (debounceTimer) window.clearTimeout(debounceTimer);
      if (q.length < 2) {
        closeSuggest();
        return;
      }

      debounceTimer = window.setTimeout(() => fetchSuggest(q), 180);
    };

    if (input) {
      input.addEventListener('input', onInput);
      input.addEventListener('focus', () => {
        if (items.length) searchbar.classList.add('is-open');
      });

      input.addEventListener('keydown', (e) => {
        if (!items.length) return;

        if (e.key === 'Escape') {
          e.preventDefault();
          closeSuggest();
          return;
        }

        if (e.key === 'ArrowDown') {
          e.preventDefault();
          const next = Math.min(activeIndex + 1, items.length - 1);
          setActiveItem(next);
          return;
        }

        if (e.key === 'ArrowUp') {
          e.preventDefault();
          const next = Math.max(activeIndex - 1, 0);
          setActiveItem(next);
          return;
        }

        if (e.key === 'Enter' && activeIndex >= 0 && items[activeIndex] && items[activeIndex].slug) {
          e.preventDefault();
          window.location.href = `/produit/${encodeURIComponent(items[activeIndex].slug)}`;
        }
      });
    }

    if (clearBtn && input) {
      clearBtn.addEventListener('click', () => {
        input.value = '';
        input.focus();
        closeSuggest();
      });
    }

    document.addEventListener('click', (e) => {
      if (!searchbar.contains(e.target)) closeSuggest();
    });
  }

  // Magnetic effect on cards
  document.querySelectorAll('.product-card, .cat-card, .fav-card').forEach(card => {
    card.addEventListener('mousemove', (e) => {
      const rect = card.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const y = e.clientY - rect.top;

      const centerX = rect.width / 2;
      const centerY = rect.height / 2;

      const rotateX = (y - centerY) / 20;
      const rotateY = (centerX - x) / 20;

      card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-8px)`;
    });

    card.addEventListener('mouseleave', () => {
      card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(0)';
    });
  });

  // Smooth scroll for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      const href = this.getAttribute('href');
      if (href !== '#') {
        e.preventDefault();
        const target = document.querySelector(href);
        if (target) {
          target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      }
    });
  });

  // Header shadow on scroll
  const header = document.querySelector('.header-new');
  if (header) {
    window.addEventListener('scroll', () => {
      if (window.scrollY > 50) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    });
  }

  // Sticky pink nav (desktop) fallback
  const desktopNav = document.querySelector('.header-new__nav');
  if (desktopNav) {
    const isDesktop = () => window.matchMedia('(min-width: 768px)').matches;
    const headerEl = document.querySelector('.header-new');
    let triggerY = null;

    const measure = () => {
      if (!isDesktop()) {
        desktopNav.classList.remove('is-fixed');
        triggerY = null;
        return;
      }

      desktopNav.classList.remove('is-fixed');

      if (headerEl) {
        const headerRect = headerEl.getBoundingClientRect();
        const navHeight = desktopNav.getBoundingClientRect().height;
        triggerY = headerRect.top + window.scrollY + headerRect.height - navHeight;
      } else {
        triggerY = desktopNav.getBoundingClientRect().top + window.scrollY;
      }
    };

    const onScroll = () => {
      if (!isDesktop() || triggerY === null) return;
      if (window.scrollY >= triggerY) {
        desktopNav.classList.add('is-fixed');
      } else {
        desktopNav.classList.remove('is-fixed');
      }
    };

    measure();
    onScroll();
    window.addEventListener('scroll', onScroll);
    window.addEventListener('resize', () => {
      measure();
      onScroll();
    });
  }

  // Scroll to top button
  const scrollTopBtn = document.getElementById('scrollTop');
  if (scrollTopBtn) {
    window.addEventListener('scroll', () => {
      if (window.scrollY > 400) {
        scrollTopBtn.classList.add('visible');
      } else {
        scrollTopBtn.classList.remove('visible');
      }
    });

    scrollTopBtn.addEventListener('click', () => {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  }

});
