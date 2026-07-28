import '../css/app.css';
import { initHeroCarousel } from './modules/hero-carousel';

/**
 * Punkt wejścia front-endu motywu xton-shop.
 * Filozofia: progresywne wzbogacanie — strona działa bez JS,
 * a skrypt jedynie dodaje ulepszenia (a11y-first).
 */

const onReady = (fn: () => void): void => {
    if (document.readyState !== 'loading') {
        fn();
    } else {
        document.addEventListener('DOMContentLoaded', fn, { once: true });
    }
};

onReady(() => {
    // Sygnalizuje CSS, że JS jest aktywny (np. do ulepszeń wymagających skryptu).
    document.documentElement.classList.remove('no-js');
    document.documentElement.classList.add('js');

    initHeroCarousel();
});
