(function () {
  const roots = Array.from(document.querySelectorAll('[data-slider]'));
  if (!roots.length) return;

  const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  function initSlider(root) {
    const track = root.querySelector('[data-slider-track]');
    const slides = Array.from(root.querySelectorAll('[data-slide]'));
    const dots = Array.from(root.querySelectorAll('[data-dot]'));
    const prevBtn = root.querySelector('[data-slider-prev]');
    const nextBtn = root.querySelector('[data-slider-next]');
    if (!track || slides.length <= 1) return;

    let index = 0;
    let timer = null;

    const setActive = (nextIndex) => {
      index = (nextIndex + slides.length) % slides.length;

      slides.forEach((s, i) => {
        s.classList.toggle('is-active', i === index);
        s.setAttribute('aria-hidden', i === index ? 'false' : 'true');
      });

      dots.forEach((d, i) => {
        d.classList.toggle('is-active', i === index);
        d.setAttribute('aria-current', i === index ? 'true' : 'false');
      });

      track.style.transform = `translateX(-${index * 100}%)`;
    };

    const stop = () => {
      if (timer) window.clearInterval(timer);
      timer = null;
    };

    const start = () => {
      if (reducedMotion) return;
      stop();
      timer = window.setInterval(() => setActive(index + 1), 5500);
    };

    dots.forEach((dot) => {
      dot.addEventListener('click', () => {
        const i = Number(dot.getAttribute('data-dot'));
        if (Number.isNaN(i)) return;
        setActive(i);
        start();
      });
    });

    if (prevBtn) {
      prevBtn.addEventListener('click', () => {
        setActive(index - 1);
        start();
      });
    }

    if (nextBtn) {
      nextBtn.addEventListener('click', () => {
        setActive(index + 1);
        start();
      });
    }

    root.addEventListener('mouseenter', stop);
    root.addEventListener('mouseleave', start);
    root.addEventListener('focusin', stop);
    root.addEventListener('focusout', start);

    // Swipe / drag support
    let startX = 0;
    let deltaX = 0;
    let dragging = false;
    let pointerId = null;

    const onPointerDown = (e) => {
      if (e.pointerType === 'mouse' && e.button !== 0) return;

      // Don't hijack clicks on controls (prev/next/dots)
      if (e.target && e.target.closest && e.target.closest('[data-slider-prev],[data-slider-next],[data-dot]')) {
        return;
      }

      dragging = true;
      pointerId = e.pointerId;
      startX = e.clientX;
      deltaX = 0;
      stop();
      try {
        root.setPointerCapture(pointerId);
      } catch (_) {
        // noop
      }
    };

    const onPointerMove = (e) => {
      if (!dragging || (pointerId !== null && e.pointerId !== pointerId)) return;
      deltaX = e.clientX - startX;
    };

    const onPointerUp = (e) => {
      if (!dragging || (pointerId !== null && e.pointerId !== pointerId)) return;
      dragging = false;
      pointerId = null;

      const threshold = 40;
      if (deltaX > threshold) setActive(index - 1);
      else if (deltaX < -threshold) setActive(index + 1);

      start();
    };

    root.addEventListener('pointerdown', onPointerDown);
    root.addEventListener('pointermove', onPointerMove);
    root.addEventListener('pointerup', onPointerUp);
    root.addEventListener('pointercancel', onPointerUp);

    // Pause when tab is hidden
    window.addEventListener('visibilitychange', () => {
      if (document.hidden) stop();
      else start();
    });

    setActive(0);
    start();
  }

  roots.forEach(initSlider);
})();
