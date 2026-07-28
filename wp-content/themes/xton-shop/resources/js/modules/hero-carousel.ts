/**
 * Hero carousel strony głównej.
 *
 * Bazuje na natywnym scroll-snap (swipe + degradacja bez JS). Skrypt dodaje:
 * strzałki, kropki (tablist), autoplay z pauzą (hover/focus/ukryta karta),
 * synchronizację przy ręcznym przewijaniu. Szanuje `prefers-reduced-motion`
 * (bez autoplay i płynnego przewijania).
 */

const AUTOPLAY_MS = 6000; // czas jednego slajdu (~6 s)
const TRANSITION_MS = 700; // wolne, płynne przejście między slajdami
const SCROLL_SETTLE_MS = 140;

const easeInOutCubic = (t: number): number =>
    t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;

export function initHeroCarousel(): void {
    document
        .querySelectorAll<HTMLElement>('[data-carousel]')
        .forEach((root) => setupCarousel(root));
}

function setupCarousel(root: HTMLElement): void {
    const track = root.querySelector<HTMLElement>('[data-carousel-track]');
    const slides = Array.from(root.querySelectorAll<HTMLElement>('[data-carousel-slide]'));
    const dotsWrap = root.querySelector<HTMLElement>('[data-carousel-dots]');

    if (!track || slides.length < 2) {
        return;
    }

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    let index = 0;
    let autoplayTimer: number | undefined;
    let rafId = 0;

    // Wolne, wygładzone przewijanie (zamiast szybkiego natywnego „smooth").
    const animateTo = (target: number): void => {
        if (prefersReducedMotion) {
            track.scrollLeft = target;
            return;
        }
        cancelAnimationFrame(rafId);
        const start = track.scrollLeft;
        const distance = target - start;
        if (Math.abs(distance) < 1) {
            return;
        }
        let startTime: number | undefined;
        const step = (now: number): void => {
            startTime ??= now;
            const progress = Math.min((now - startTime) / TRANSITION_MS, 1);
            track.scrollLeft = start + distance * easeInOutCubic(progress);
            if (progress < 1) {
                rafId = requestAnimationFrame(step);
            }
        };
        rafId = requestAnimationFrame(step);
    };

    // Kropki (tablist) budowane po stronie JS — bez JS nie mają sensu.
    const dots = slides.map((_, i) => {
        const dot = document.createElement('button');
        dot.type = 'button';
        dot.className = 'hero-dot';
        dot.setAttribute('role', 'tab');
        dot.setAttribute('aria-label', `Slajd ${i + 1}`);
        dot.addEventListener('click', () => {
            goTo(i);
            restartAutoplay();
        });
        dotsWrap?.appendChild(dot);
        return dot;
    });

    const goTo = (next: number): void => {
        index = (next + slides.length) % slides.length;
        animateTo(track.clientWidth * index);
        sync();
    };

    const sync = (): void => {
        dots.forEach((dot, i) => dot.setAttribute('aria-current', String(i === index)));
        slides.forEach((slide, i) => slide.setAttribute('aria-hidden', String(i !== index)));
    };

    root.querySelector('[data-carousel-prev]')?.addEventListener('click', () => {
        goTo(index - 1);
        restartAutoplay();
    });
    root.querySelector('[data-carousel-next]')?.addEventListener('click', () => {
        goTo(index + 1);
        restartAutoplay();
    });

    // Synchronizacja indeksu po ręcznym przewinięciu (swipe / scroll).
    let settleTimer: number | undefined;
    track.addEventListener(
        'scroll',
        () => {
            window.clearTimeout(settleTimer);
            settleTimer = window.setTimeout(() => {
                const current = Math.round(track.scrollLeft / track.clientWidth);
                if (current !== index) {
                    index = current;
                    sync();
                }
            }, SCROLL_SETTLE_MS);
        },
        { passive: true }
    );

    const startAutoplay = (): void => {
        if (prefersReducedMotion) {
            return;
        }
        stopAutoplay();
        autoplayTimer = window.setInterval(() => goTo(index + 1), AUTOPLAY_MS);
    };
    const stopAutoplay = (): void => window.clearInterval(autoplayTimer);
    const restartAutoplay = (): void => {
        stopAutoplay();
        startAutoplay();
    };

    root.addEventListener('mouseenter', stopAutoplay);
    root.addEventListener('mouseleave', startAutoplay);
    root.addEventListener('focusin', stopAutoplay);
    root.addEventListener('focusout', startAutoplay);
    document.addEventListener('visibilitychange', () => {
        document.hidden ? stopAutoplay() : startAutoplay();
    });

    sync();
    startAutoplay();
}
