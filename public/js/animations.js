// Smooth scroll animations on page load and scroll
document.addEventListener('DOMContentLoaded', function() {

  // Hamburger menu toggle
  const hamburger = document.getElementById('hamburger');
  const nav = document.querySelector('.header-new__nav');
  const navClose = document.getElementById('nav-close');

  const closeMenu = () => {
    hamburger.classList.remove('active');
    nav.classList.remove('active');
    document.body.style.overflow = '';
    hamburger.setAttribute('aria-expanded', 'false');
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

    // Close button
    if (navClose) {
      navClose.addEventListener('click', closeMenu);
    }

    // Close menu when clicking a link
    nav.querySelectorAll('.nav-link').forEach(link => {
      link.addEventListener('click', closeMenu);
    });

    // Close on escape key
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && nav.classList.contains('active')) {
        closeMenu();
      }
    });
  }

  // Elements to animate on scroll
  const observerOptions = {
    root: null,
    rootMargin: '0px',
    threshold: 0.1
  };

  const animateOnScroll = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-visible');

        // Stagger children animations
        const children = entry.target.querySelectorAll('.stagger-child');
        children.forEach((child, index) => {
          child.style.animationDelay = `${index * 0.1}s`;
          child.classList.add('is-visible');
        });
      }
    });
  }, observerOptions);

  // Observe all sections and cards
  document.querySelectorAll('section, .product-card, .cat-card, .guarantee, .article-card, .acc-card, .fav-card, .space-card, .brand-logo').forEach(el => {
    el.classList.add('reveal');
    animateOnScroll.observe(el);
  });

  // Parallax effect on hero
  const hero = document.querySelector('.hero__bg img');
  if (hero) {
    window.addEventListener('scroll', () => {
      const scrolled = window.pageYOffset;
      hero.style.transform = `translateY(${scrolled * 0.3}px) scale(1.1)`;
    });
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
