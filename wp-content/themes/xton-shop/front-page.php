<?php

/**
 * Strona główna sklepu.
 *
 * Sekcje: hero carousel → kategorie → oferty specjalne.
 * Etap: design-first (dane placeholder). Podpięcie pod WooCommerce później —
 * markup iteruje po tablicach, więc wystarczy podmienić źródło danych.
 *
 * @package XtonShop
 */

declare(strict_types=1);

get_header();
?>

<main id="main" role="main">
    <?php
    get_template_part('templates/parts/home/carousel');
    get_template_part('templates/parts/home/categories');
    get_template_part('templates/parts/home/offers');
    ?>
</main>

<?php
get_footer();
