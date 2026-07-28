<?php

/**
 * Nagłówek dokumentu i otwarcie <body>.
 *
 * @package XtonShop
 */

declare(strict_types=1);

?><!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class('min-h-screen bg-base-100 text-base-content antialiased'); ?>>
<?php wp_body_open(); ?>

<a class="sr-only focus:not-sr-only focus:absolute focus:z-50 focus:top-2 focus:left-2 btn btn-primary" href="#main">
    <?php esc_html_e('Przejdź do treści', 'xton-shop'); ?>
</a>

<header class="site-header border-b border-base-200" role="banner">
    <div class="container mx-auto flex items-center justify-between gap-4 px-4 py-4">
        <div class="site-branding">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a class="text-xl font-bold" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                    <?php bloginfo('name'); ?>
                </a>
            <?php endif; ?>
        </div>

        <nav class="primary-navigation" aria-label="<?php esc_attr_e('Nawigacja główna', 'xton-shop'); ?>">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'flex items-center gap-6',
                'fallback_cb'    => false,
                'depth'          => 2,
            ]);
            ?>
        </nav>
    </div>
</header>
