/**
 * Nawigacja headera — przełącznik menu mobilnego.
 *
 * Progresywne wzbogacanie: bez JS nawigacja pozostaje w DOM (na desktopie
 * i tak widoczna). Skrypt dodaje jedynie rozwijanie na mobile + a11y
 * (aria-expanded, zamykanie Escape / kliknięciem poza / przy powrocie na desktop).
 */

const DESKTOP_MEDIA = '(min-width: 1024px)';

export function initHeaderNav(): void {
    const toggle = document.querySelector<HTMLButtonElement>('[data-nav-toggle]');
    const nav = document.querySelector<HTMLElement>('[data-nav]');

    if (!toggle || !nav) {
        return;
    }

    const setOpen = (open: boolean): void => {
        nav.classList.toggle('is-open', open);
        toggle.setAttribute('aria-expanded', String(open));
    };

    toggle.addEventListener('click', () => {
        setOpen(!nav.classList.contains('is-open'));
    });

    // Zamknij po kliknięciu w link w menu.
    nav.addEventListener('click', (event) => {
        if ((event.target as HTMLElement).closest('a')) {
            setOpen(false);
        }
    });

    // Zamknij klawiszem Escape.
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            setOpen(false);
        }
    });

    // Zamknij kliknięciem poza headerem.
    document.addEventListener('click', (event) => {
        if (!nav.contains(event.target as Node) && !toggle.contains(event.target as Node)) {
            setOpen(false);
        }
    });

    // Po powrocie na desktop wyzeruj stan mobilny.
    window.matchMedia(DESKTOP_MEDIA).addEventListener('change', (event) => {
        if (event.matches) {
            setOpen(false);
        }
    });
}
