// Moonbaza — main frontend entry
// Imported by resources/views/layouts/app.blade.php via @vite(...)

import '../css/app.css';

/* ------------------------------------------------------------------
 * Mobile nav toggle
 * Add  data-nav-toggle  to your hamburger button and
 *      data-nav-menu    to the <nav> wrapper in layouts/app.blade.php.
 * ------------------------------------------------------------------ */
function initNav() {
    const toggle = document.querySelector('[data-nav-toggle]');
    const menu   = document.querySelector('[data-nav-menu]');
    if (!toggle || !menu) return;

    toggle.addEventListener('click', () => {
        const open = menu.classList.toggle('is-open');
        toggle.setAttribute('aria-expanded', String(open));
    });

    // Close when a link is clicked (nice on mobile)
    menu.addEventListener('click', (e) => {
        if (e.target.closest('a')) {
            menu.classList.remove('is-open');
            toggle.setAttribute('aria-expanded', 'false');
        }
    });
}

/* ------------------------------------------------------------------
 * "Back to top" button
 * Add  <button data-back-to-top>↑</button>  anywhere in the layout.
 * ------------------------------------------------------------------ */
function initBackToTop() {
    const btn = document.querySelector('[data-back-to-top]');
    if (!btn) return;

    const update = () => {
        btn.classList.toggle('is-visible', window.scrollY > 400);
    };

    window.addEventListener('scroll', update, { passive: true });
    update();

    btn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}

/* ------------------------------------------------------------------
 * Smooth-scroll for in-page anchors (href="#foo").
 * Respects the user's "reduce motion" preference.
 * ------------------------------------------------------------------ */
function initSmoothAnchors() {
    const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reduce) return;

    document.addEventListener('click', (e) => {
        const a = e.target.closest('a[href^="#"]');
        if (!a) return;

        const id = a.getAttribute('href');
        if (!id || id === '#') return;

        const target = document.querySelector(id);
        if (!target) return;

        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        history.replaceState(null, '', id);
    });
}

/* ------------------------------------------------------------------
 * Wishlist CTA — the config uses url "#".
 * Until you have a real store link, make it say "coming soon".
 * ------------------------------------------------------------------ */
function initWishlistCta() {
    const cta = document.querySelector('[data-cta]');
    if (!cta) return;

    if (cta.getAttribute('href') === '#') {
        cta.addEventListener('click', (e) => {
            e.preventDefault();
            // Replace with a toast / modal later if you want.
            alert('Wishlist link coming soon — follow us for updates!');
        });
    }
}

/* ------------------------------------------------------------------
 * Boot
 * ------------------------------------------------------------------ */
function boot() {
    initNav();
    initBackToTop();
    initSmoothAnchors();
    initWishlistCta();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
} else {
    boot();
}