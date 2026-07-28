<?php

/**
 * Główny szablon (fallback dla całej hierarchii szablonów).
 *
 * @package XtonShop
 */

declare(strict_types=1);

get_header();
?>

<main id="main" class="site-main" role="main">
    <div class="container mx-auto px-4 py-8">
        <?php if (have_posts()) : ?>
            <div class="grid gap-8">
                <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('templates/parts/content', get_post_type());
                endwhile;
                ?>
            </div>

            <?php
            the_posts_pagination([
                'mid_size'  => 1,
                'prev_text' => esc_html__('Poprzednie', 'xton-shop'),
                'next_text' => esc_html__('Następne', 'xton-shop'),
            ]);
            ?>
        <?php else : ?>
            <?php get_template_part('templates/parts/content', 'none'); ?>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
