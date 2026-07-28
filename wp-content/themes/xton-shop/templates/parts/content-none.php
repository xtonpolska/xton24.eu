<?php

/**
 * Komunikat, gdy brak treści.
 *
 * @package XtonShop
 */

declare(strict_types=1);

?>
<section class="hero bg-base-200 rounded-box py-16">
    <div class="hero-content text-center">
        <div class="max-w-md">
            <h1 class="text-2xl font-bold">
                <?php esc_html_e('Nic tu nie ma', 'xton-shop'); ?>
            </h1>
            <p class="py-4 text-base-content/70">
                <?php esc_html_e('Nie znaleziono treści. Spróbuj wyszukać.', 'xton-shop'); ?>
            </p>
            <?php get_search_form(); ?>
        </div>
    </div>
</section>
