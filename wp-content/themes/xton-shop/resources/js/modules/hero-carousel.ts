import Swiper from 'swiper';
import { A11y, Autoplay, Keyboard, Navigation, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

/**
 * Inicjalizuje hero carousel (Swiper) na stronie głównej.
 * A11y-first: klawiatura, komunikaty czytnika ekranu, autoplay wyłączany
 * przy prefers-reduced-motion i pauzowany po najechaniu myszą.
 */
export function initHeroCarousel(): void {
    const root = document.querySelector<HTMLElement>('[data-hero-carousel]');

    if (root === null) {
        return;
    }

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    new Swiper(root, {
        modules: [Navigation, Pagination, Autoplay, A11y, Keyboard],
        loop: true,
        speed: 600,
        grabCursor: true,
        autoplay: prefersReducedMotion
            ? false
            : { delay: 6000, disableOnInteraction: false, pauseOnMouseEnter: true },
        keyboard: { enabled: true },
        a11y: {
            enabled: true,
            prevSlideMessage: 'Poprzedni slajd',
            nextSlideMessage: 'Następny slajd',
            paginationBulletMessage: 'Przejdź do slajdu {{index}}',
        },
        pagination: {
            el: root.querySelector<HTMLElement>('[data-hero-pagination]'),
            clickable: true,
        },
        navigation: {
            prevEl: root.querySelector<HTMLElement>('[data-hero-prev]'),
            nextEl: root.querySelector<HTMLElement>('[data-hero-next]'),
        },
    });
}
