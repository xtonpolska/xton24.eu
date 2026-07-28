<?php

/**
 * Strona główna sklepu.
 *
 * Czysty szkielet — dotychczasowe sekcje (hero/kategorie/oferty) usunięte,
 * bo nie oddawały brandu XTON. Do zbudowania od nowa wg referencji Figma.
 *
 * @package XtonShop
 */

declare(strict_types=1);

get_header();
?>

<main id="main" role="main">
    <?php get_template_part('templates/parts/home/hero-carousel'); ?>
    <?php get_template_part('templates/parts/home/categories'); ?>
</main>

<?php
get_footer();
