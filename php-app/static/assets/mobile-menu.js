(() => {
  const toggle = document.querySelector('.nav-toggle');
  const nav = document.querySelector('#primary-navigation');

  if (!toggle || !nav) return;

  const mobileViewport = window.matchMedia('(max-width: 800px)');

  function setMenuOpen(open) {
    toggle.setAttribute('aria-expanded', String(open));
    toggle.setAttribute('aria-label', open ? 'Tutup menu navigasi' : 'Buka menu navigasi');
    nav.classList.toggle('is-open', open);
  }

  toggle.addEventListener('click', () => {
    setMenuOpen(toggle.getAttribute('aria-expanded') !== 'true');
  });

  nav.querySelectorAll('a').forEach((link) => {
    link.addEventListener('click', () => setMenuOpen(false));
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') {
      setMenuOpen(false);
      toggle.focus();
    }
  });

  document.addEventListener('pointerdown', (event) => {
    if (!toggle.contains(event.target) && !nav.contains(event.target)) {
      setMenuOpen(false);
    }
  });

  mobileViewport.addEventListener('change', (event) => {
    if (!event.matches) setMenuOpen(false);
  });
})();

//# sourceURL=mobile-menu.js
