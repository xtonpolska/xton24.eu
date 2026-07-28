<?php

/**
 * Sekcja ofert specjalnych (produkty w promocji).
 *
 * @package XtonShop
 */

declare(strict_types=1);

/*
 * DANE PLACEHOLDER (design-first).
 * TODO(wp): zastąpić przez wc_get_product_ids_on_sale() / WC_Product —
 * name, permalink, image, price_html, regular/sale price, rating. Markup bez zmian.
 */
$offers = [
    ['name' => 'Słuchawki bezprzewodowe ANC', 'brand' => 'AudioMax', 'price' => '299,00', 'old' => '499,00', 'discount' => 40, 'rating' => 5, 'reviews' => 128, 'gradient' => 'from-slate-700 to-slate-900'],
    ['name' => 'Smartwatch Sport GPS',        'brand' => 'FitPro',   'price' => '449,00', 'old' => '599,00', 'discount' => 25, 'rating' => 4, 'reviews' => 86,  'gradient' => 'from-indigo-600 to-blue-800'],
    ['name' => 'Ekspres ciśnieniowy 19 bar',  'brand' => 'BaristaHome', 'price' => '899,00', 'old' => '1 199,00', 'discount' => 25, 'rating' => 5, 'reviews' => 54, 'gradient' => 'from-amber-600 to-orange-800'],
    ['name' => 'Robot sprzątający Lidar',     'brand' => 'CleanBot', 'price' => '1 099,00', 'old' => '1 599,00', 'discount' => 31, 'rating' => 4, 'reviews' => 203, 'gradient' => 'from-teal-600 to-emerald-800'],
];
?>

<section id="oferty-specjalne" class="scroll-mt-8 bg-base-200/50 py-14 md:py-20" aria-labelledby="oferty-heading">
    <div class="container mx-auto px-4">
        <div class="mb-8 flex flex-wrap items-end justify-between gap-4">
            <div>
                <h2 id="oferty-heading" class="text-2xl font-bold tracking-tight md:text-3xl">
                    <?php esc_html_e('Oferty specjalne', 'xton-shop'); ?>
                </h2>
                <p class="mt-1 text-base-content/70">
                    <?php esc_html_e('Najlepsze okazje w tym tygodniu — dopóki są dostępne.', 'xton-shop'); ?>
                </p>
            </div>
            <a class="btn btn-ghost btn-sm" href="#">
                <?php esc_html_e('Zobacz wszystkie promocje', 'xton-shop'); ?> &rarr;
            </a>
        </div>

        <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4" role="list">
            <?php foreach ($offers as $offer) : ?>
                <li class="group flex flex-col overflow-hidden rounded-2xl border border-base-200 bg-base-100 transition hover:shadow-xl">
                    <!-- Obszar obrazu (placeholder) -->
                    <div class="relative aspect-square overflow-hidden bg-linear-to-br <?php echo esc_attr($offer['gradient']); ?>">
                        <span class="absolute left-3 top-3 badge badge-error font-semibold text-white">
                            -<?php echo esc_html((string) $offer['discount']); ?>%
                        </span>
                        <button type="button"
                                class="absolute right-3 top-3 btn btn-circle btn-sm border-none bg-white/85 text-neutral-700 hover:bg-white"
                                aria-label="<?php esc_attr_e('Dodaj do ulubionych', 'xton-shop'); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>
                    </div>

                    <div class="flex flex-1 flex-col gap-2 p-4">
                        <span class="text-xs font-medium uppercase tracking-wide text-base-content/50">
                            <?php echo esc_html($offer['brand']); ?>
                        </span>

                        <h3 class="font-semibold leading-snug">
                            <a href="#" class="after:absolute after:inset-0"><?php echo esc_html($offer['name']); ?></a>
                        </h3>

                        <!-- Ocena -->
                        <div class="flex items-center gap-2">
                            <div class="flex text-amber-400" aria-hidden="true">
                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="<?php echo $i <= $offer['rating'] ? 'currentColor' : 'none'; ?>" stroke="currentColor">
                                        <path stroke-width="1.5" d="M9.05 2.93c.3-.92 1.6-.92 1.9 0l1.36 4.18a1 1 0 00.95.69h4.4c.97 0 1.37 1.24.59 1.81l-3.56 2.59a1 1 0 00-.36 1.12l1.36 4.18c.3.92-.76 1.69-1.54 1.12l-3.56-2.59a1 1 0 00-1.18 0l-3.56 2.59c-.78.57-1.84-.2-1.54-1.12l1.36-4.18a1 1 0 00-.36-1.12L2.1 9.6c-.78-.57-.38-1.81.59-1.81h4.4a1 1 0 00.95-.69l1.36-4.18z" />
                                    </svg>
                                <?php endfor; ?>
                            </div>
                            <span class="text-xs text-base-content/60">
                                (<?php echo esc_html((string) $offer['reviews']); ?>)
                            </span>
                        </div>

                        <!-- Cena -->
                        <div class="mt-1 flex items-baseline gap-2">
                            <span class="text-lg font-bold text-error">
                                <?php echo esc_html($offer['price']); ?> zł
                            </span>
                            <span class="text-sm text-base-content/50 line-through">
                                <?php echo esc_html($offer['old']); ?> zł
                            </span>
                        </div>

                        <button type="button" class="btn btn-primary btn-sm relative z-10 mt-3 w-full">
                            <?php esc_html_e('Dodaj do koszyka', 'xton-shop'); ?>
                        </button>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
