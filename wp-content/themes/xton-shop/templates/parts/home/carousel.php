<?php

/**
 * Sekcja hero — carousel (Swiper).
 *
 * @package XtonShop
 */

declare(strict_types=1);

/*
 * DANE PLACEHOLDER (design-first).
 * TODO(wp): zastąpić źródłem z WordPress (np. CPT „Slajdy" albo wyróżnione produkty).
 * Markup poniżej pozostanie bez zmian — wystarczy zbudować tę tablicę z danych WP.
 */
$slides = [
    [
        'eyebrow'   => 'Nowa kolekcja',
        'title'     => 'Sprzęt, który nadąża za Tobą',
        'text'      => 'Odkryj starannie wyselekcjonowane produkty w najlepszych cenach. Darmowa dostawa od 199 zł.',
        'cta'       => 'Zobacz nowości',
        'cta_url'   => '#',
        'link2'     => 'Wszystkie kategorie',
        'link2_url' => '#kategorie',
        'gradient'  => 'from-indigo-600 via-violet-600 to-purple-700',
    ],
    [
        'eyebrow'   => 'Promocja tygodnia',
        'title'     => 'Do -40% na wybrane produkty',
        'text'      => 'Tylko w tym tygodniu — złap okazję, zanim zniknie. Liczba sztuk ograniczona.',
        'cta'       => 'Przejdź do promocji',
        'cta_url'   => '#oferty-specjalne',
        'link2'     => 'Regulamin promocji',
        'link2_url' => '#',
        'gradient'  => 'from-rose-500 via-pink-600 to-fuchsia-700',
    ],
    [
        'eyebrow'   => 'Dla domu i ogrodu',
        'title'     => 'Wygoda w każdym detalu',
        'text'      => 'Praktyczne rozwiązania, które ułatwią codzienność. Sprawdzona jakość, szybka wysyłka.',
        'cta'       => 'Odkryj kategorię',
        'cta_url'   => '#kategorie',
        'link2'     => 'Poznaj marki',
        'link2_url' => '#',
        'gradient'  => 'from-emerald-500 via-teal-600 to-cyan-700',
    ],
];
?>

<section class="hero-section" aria-label="<?php esc_attr_e('Wyróżnione oferty', 'xton-shop'); ?>">
    <div class="swiper hero-swiper" data-hero-carousel>
        <div class="swiper-wrapper">
            <?php foreach ($slides as $slide) : ?>
                <div class="swiper-slide">
                    <div class="relative overflow-hidden bg-linear-to-br <?php echo esc_attr($slide['gradient']); ?> text-white">
                        <div class="container mx-auto px-4">
                            <div class="flex min-h-95 max-w-2xl flex-col justify-center gap-5 py-16 md:min-h-120 md:py-24">
                                <?php if (! empty($slide['eyebrow'])) : ?>
                                    <span class="inline-flex w-fit items-center rounded-full bg-white/15 px-3 py-1 text-sm font-medium backdrop-blur">
                                        <?php echo esc_html($slide['eyebrow']); ?>
                                    </span>
                                <?php endif; ?>

                                <h2 class="text-3xl font-extrabold leading-tight tracking-tight md:text-5xl">
                                    <?php echo esc_html($slide['title']); ?>
                                </h2>

                                <p class="max-w-xl text-base text-white/90 md:text-lg">
                                    <?php echo esc_html($slide['text']); ?>
                                </p>

                                <div class="mt-2 flex flex-wrap items-center gap-4">
                                    <a class="btn btn-lg border-none bg-white text-neutral-900 hover:bg-white/90"
                                       href="<?php echo esc_url($slide['cta_url']); ?>">
                                        <?php echo esc_html($slide['cta']); ?>
                                    </a>
                                    <?php if (! empty($slide['link2'])) : ?>
                                        <a class="link link-hover font-medium text-white/90"
                                           href="<?php echo esc_url($slide['link2_url']); ?>">
                                            <?php echo esc_html($slide['link2']); ?> &rarr;
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Dekoracyjny akcent tła -->
                        <div class="pointer-events-none absolute -right-24 -top-24 h-96 w-96 rounded-full bg-white/10 blur-2xl" aria-hidden="true"></div>
                        <div class="pointer-events-none absolute -bottom-32 right-32 h-72 w-72 rounded-full bg-black/10 blur-2xl" aria-hidden="true"></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Paginacja (kropki) -->
        <div class="swiper-pagination bottom-4!" data-hero-pagination></div>

        <!-- Nawigacja (strzałki) -->
        <button type="button"
                class="btn btn-circle btn-sm absolute left-4 top-1/2 z-10 hidden -translate-y-1/2 border-none bg-white/25 text-white hover:bg-white/40 md:inline-flex"
                data-hero-prev aria-label="<?php esc_attr_e('Poprzedni slajd', 'xton-shop'); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <button type="button"
                class="btn btn-circle btn-sm absolute right-4 top-1/2 z-10 hidden -translate-y-1/2 border-none bg-white/25 text-white hover:bg-white/40 md:inline-flex"
                data-hero-next aria-label="<?php esc_attr_e('Następny slajd', 'xton-shop'); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>
</section>
