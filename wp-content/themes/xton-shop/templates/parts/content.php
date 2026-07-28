<?php

/**
 * Domyślny wpis w pętli.
 *
 * @package XtonShop
 */

declare(strict_types=1);

?>
<article <?php post_class('card bg-base-100 shadow-sm'); ?> id="post-<?php the_ID(); ?>">
    <?php if (has_post_thumbnail()) : ?>
        <figure>
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('large', ['class' => 'w-full h-auto', 'loading' => 'lazy']); ?>
            </a>
        </figure>
    <?php endif; ?>

    <div class="card-body">
        <h2 class="card-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>

        <div class="prose max-w-none">
            <?php the_excerpt(); ?>
        </div>

        <div class="card-actions justify-end">
            <a class="btn btn-primary btn-sm" href="<?php the_permalink(); ?>">
                <?php esc_html_e('Czytaj więcej', 'xton-shop'); ?>
            </a>
        </div>
    </div>
</article>
