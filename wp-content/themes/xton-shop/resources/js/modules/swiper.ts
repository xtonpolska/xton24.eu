/**
 * Reużywalny inicjalizator Swiper dla wszystkich karuzeli w motywie.
 *
 * Konwencja (markup):
 *   <div data-swiper='{ ...opcje Swiper... }'>   ← wrapper z opcjami (JSON, opcjonalnie)
 *       <div class="swiper"> <div class="swiper-wrapper"> .swiper-slide … </div> </div>
 *       <div class="swiper-pagination"></div>     ← opcjonalnie (może być poza .swiper)
 *       <button class="swiper-prev">…</button>    ← opcjonalnie
 *       <button class="swiper-next">…</button>
 *   </div>
 *
 * Strzałki i paginacja są wyszukiwane w obrębie wrappera, więc mogą leżeć POZA
 * elementem `.swiper` (np. w osobnym pasku kontrolek). Szanuje
 * `prefers-reduced-motion` (bez autoplay, bez animacji przejścia).
 */

import Swiper from 'swiper';
import { A11y, Autoplay, EffectFade, Keyboard, Navigation, Pagination } from 'swiper/modules';
import type { SwiperOptions } from 'swiper/types';

import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/effect-fade';

export function initSwipers(): void {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    document.querySelectorAll<HTMLElement>('[data-swiper]').forEach((root) => {
        const container = root.querySelector<HTMLElement>('.swiper');

        if (!container) {
            return;
        }

        let overrides: SwiperOptions = {};
        try {
            overrides = root.dataset.swiper ? (JSON.parse(root.dataset.swiper) as SwiperOptions) : {};
        } catch {
            overrides = {};
        }

        const prev = root.querySelector<HTMLElement>('.swiper-prev');
        const next = root.querySelector<HTMLElement>('.swiper-next');
        const pagination = root.querySelector<HTMLElement>('.swiper-pagination');

        const config: SwiperOptions = {
            modules: [Navigation, Pagination, Autoplay, Keyboard, A11y, EffectFade],
            speed: 600,
            slidesPerView: 1,
            keyboard: { enabled: true },
            a11y: { enabled: true },
            ...overrides,
        };

        if (prev && next) {
            config.navigation = { prevEl: prev, nextEl: next };
        }

        if (pagination) {
            config.pagination = { el: pagination, clickable: true };
        }

        // Reduced motion: bez autoplay i bez animacji przejścia.
        if (prefersReducedMotion) {
            config.speed = 0;
            delete config.autoplay;
        }

        new Swiper(container, config);
    });
}
