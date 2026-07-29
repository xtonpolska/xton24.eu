<?php

/**
 * Sekcja hero — carousel na stronie głównej (Swiper).
 *
 * Ciemny panel zamknięty w `.container` (nie od krawędzi do krawędzi),
 * lekko zaokrąglony. Po lewej: treść + CTA na tle ink; po prawej: grafika,
 * która rozpływa się w tle panelu gradientem („dissolve"). Ciemny motyw jest
 * lokalny dla tej sekcji (element designu) — reszta strony pozostaje jasna.
 *
 * Mechanika: Swiper (reużywalny init `resources/js/modules/swiper.ts`) — opcje
 * w atrybucie `data-swiper`, strzałki/paginacja w pasku kontrolek POZA panelem.
 *
 * DANE PLACEHOLDER (grafiki z placehold.co) — do podmiany na źródło z WP.
 *
 * @package XtonShop
 */

declare(strict_types=1);

$slides = [
    [
        'eyebrow' => 'Nowa kolekcja',
        'title'   => 'Moc, która robi robotę',
        'desc'    => 'Profesjonalny sprzęt dobrany pod Twoje zadania. Sprawdzone marki, ekspresowa wysyłka.',
        'cta'     => 'Zobacz nowości',
        'cta_url' => '#',
        'link'    => 'Wszystkie kategorie',
        'link_url' => '#',
        'image'   => 'https://placehold.co/1200x1000/1f1f1f/ffd600?text=Nowo%C5%9Bci',
    ],
    [
        'eyebrow' => 'Promocja tygodnia',
        'title'   => 'Do -40% na wybrane modele',
        'desc'    => 'Łap okazję, zanim zniknie — liczba sztuk ograniczona.',
        'cta'     => 'Przejdź do promocji',
        'cta_url' => '#',
        'link'    => 'Regulamin promocji',
        'link_url' => '#',
        'image'   => 'https://placehold.co/1200x1000/171717/ffa600?text=Promocje',
    ],
    [
        'eyebrow' => 'Dla profesjonalistów',
        'title'   => 'Wyposaż swój warsztat',
        'desc'    => 'Wszystko w jednym miejscu — z doradztwem i gwarancją.',
        'cta'     => 'Poznaj ofertę',
        'cta_url' => '#',
        'link'    => 'Skontaktuj się',
        'link_url' => '#',
        'image'   => 'https://placehold.co/1200x1000/262626/fafafa?text=Warsztat',
    ],
];

// Opcje Swiper (odczytywane przez resources/js/modules/swiper.ts).
$swiper_options = [
    'loop'     => true,
    'speed'    => 700, // wolne, płynne przejście
    'autoplay' => [
        'delay'                => 6000, // ~6 s na slajd
        'disableOnInteraction' => false,
        'pauseOnMouseEnter'    => true,
    ],
];
?>

<section class="home-hero" aria-label="<?php esc_attr_e('Wyróżnione oferty', 'xton-shop'); ?>">
    <div class="container">
        <div class="hero-wrap" data-swiper="<?php echo esc_attr((string) wp_json_encode($swiper_options)); ?>">
            <div class="hero-carousel swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($slides as $i => $slide) : ?>
                        <article class="hero-slide swiper-slide">
                            <div class="hero-slide__media" aria-hidden="true">
                                <img src="<?php echo esc_url($slide['image']); ?>" alt="" width="1200" height="1000" loading="<?php echo $i === 0 ? 'eager' : 'lazy'; ?>">
                            </div>

                            <div class="hero-slide__content">
                                <p class="hero-slide__eyebrow"><?php echo esc_html($slide['eyebrow']); ?></p>
                                <h2 class="hero-slide__title"><?php echo esc_html($slide['title']); ?></h2>
                                <p class="hero-slide__desc"><?php echo esc_html($slide['desc']); ?></p>
                                <div class="hero-slide__actions">
                                    <a class="btn btn-xton btn-lg" href="<?php echo esc_url($slide['cta_url']); ?>">
                                        <?php echo esc_html($slide['cta']); ?>
                                    </a>
                                    <?php if (! empty($slide['link'])) : ?>
                                        <a class="hero-slide__link" href="<?php echo esc_url($slide['link_url']); ?>">
                                            <?php echo esc_html($slide['link']); ?> &rarr;
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php // Kontrolki poza panelem (na jasnym tle strony) — Swiper wiąże je po klasach. ?>
            <div class="hero-controls">
                <div class="hero-controls__dots swiper-pagination"></div>
                <div class="hero-controls__arrows">
                    <button type="button" class="hero-arrow swiper-prev" aria-label="<?php esc_attr_e('Poprzedni slajd', 'xton-shop'); ?>">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true" width="20" height="20">
                            <path d="M15 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                    <button type="button" class="hero-arrow swiper-next" aria-label="<?php esc_attr_e('Następny slajd', 'xton-shop'); ?>">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true" width="20" height="20">
                            <path d="M9 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
