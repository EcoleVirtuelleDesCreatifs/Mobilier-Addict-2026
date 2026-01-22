(function () {
  const root = document.querySelector('[data-slider]');
  if (!root) return;

  const track = root.querySelector('[data-slider-track]');
  const slides = Array.from(root.querySelectorAll('[data-slide]'));
  const dots = Array.from(root.querySelectorAll('[data-dot]'));
  const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  let index = 0;
  let timer = null;

  function setActive(nextIndex) {
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
  }

  function stop() {
    if (timer) window.clearInterval(timer);
    timer = null;
  }

  function start() {
    if (reducedMotion) return;
    stop();
    timer = window.setInterval(() => setActive(index + 1), 5500);
  }

  dots.forEach((dot) => {
    dot.addEventListener('click', () => {
      const i = Number(dot.getAttribute('data-dot'));
      setActive(i);
      start();
    });
  });

  root.addEventListener('mouseenter', stop);
  root.addEventListener('mouseleave', start);
  root.addEventListener('focusin', stop);
  root.addEventListener('focusout', start);

  window.addEventListener('visibilitychange', () => {
    if (document.hidden) stop();
    else start();
  });

  setActive(0);
  start();
})();
