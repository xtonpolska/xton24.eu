<?php

/**
 * Sekcja kategorii.
 *
 * @package XtonShop
 */

declare(strict_types=1);

/*
 * DANE PLACEHOLDER (design-first).
 * TODO(wp): zastąpić przez get_terms('product_cat') (WooCommerce) —
 * name, link, thumbnail, count. Markup bez zmian.
 */
$categories = [
    ['name' => 'Elektronika',   'count' => 124, 'icon' => '💻', 'gradient' => 'from-sky-500 to-indigo-500'],
    ['name' => 'Dom i ogród',   'count' => 98,  'icon' => '🪴', 'gradient' => 'from-emerald-500 to-teal-500'],
    ['name' => 'Moda',          'count' => 156, 'icon' => '👕', 'gradient' => 'from-pink-500 to-rose-500'],
    ['name' => 'Sport',         'count' => 72,  'icon' => '🏀', 'gradient' => 'from-orange-500 to-amber-500'],
    ['name' => 'Dziecko',       'count' => 64,  'icon' => '🧸', 'gradient' => 'from-violet-500 to-purple-500'],
    ['name' => 'Zdrowie',       'count' => 41,  'icon' => '🧴', 'gradient' => 'from-cyan-500 to-blue-500'],
];
?>

<section id="kategorie" class="scroll-mt-8 py-14 md:py-20" aria-labelledby="kategorie-heading">
    <div class="container mx-auto px-4">
        <div class="mb-8 flex flex-wrap items-end justify-between gap-4">
            <div>
                <h2 id="kategorie-heading" class="text-2xl font-bold tracking-tight md:text-3xl">
                    <?php esc_html_e('Kupuj według kategorii', 'xton-shop'); ?>
                </h2>
                <p class="mt-1 text-base-content/70">
                    <?php esc_html_e('Wybierz kategorię i znajdź to, czego szukasz.', 'xton-shop'); ?>
                </p>
            </div>
            <a class="btn btn-ghost btn-sm" href="#">
                <?php esc_html_e('Wszystkie kategorie', 'xton-shop'); ?> &rarr;
            </a>
        </div>

        <ul class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6" role="list">
            <?php foreach ($categories as $category) : ?>
                <li>
                    <a href="#"
                       class="group flex h-full flex-col items-center gap-3 rounded-2xl border border-base-200 bg-base-100 p-5 text-center transition hover:-translate-y-1 hover:border-primary/40 hover:shadow-lg">
                        <span class="flex h-16 w-16 items-center justify-center rounded-full bg-linear-to-br <?php echo esc_attr($category['gradient']); ?> text-3xl shadow-sm transition group-hover:scale-105"
                              aria-hidden="true">
                            <?php echo esc_html($category['icon']); ?>
                        </span>
                        <span class="font-semibold leading-tight">
                            <?php echo esc_html($category['name']); ?>
                        </span>
                        <span class="text-sm text-base-content/60">
                            <?php
                            /* translators: %d: liczba produktów w kategorii. */
                            echo esc_html(sprintf(_n('%d produkt', '%d produktów', $category['count'], 'xton-shop'), $category['count']));
                            ?>
                        </span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
