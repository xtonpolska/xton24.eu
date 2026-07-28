<?php

declare(strict_types=1);

namespace XtonShop\Setup;

use XtonShop\Support\Contracts\Bootable;

/**
 * Deklaruje wsparcie funkcji WordPressa i WooCommerce.
 */
final class ThemeSupport implements Bootable
{
    public function boot(): void
    {
        add_action('after_setup_theme', [$this, 'register']);
    }

    public function register(): void
    {
        load_theme_textdomain('xton-shop', get_template_directory() . '/languages');

        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('automatic-feed-links');
        add_theme_support('responsive-embeds');
        add_theme_support('html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
            'navigation-widgets',
        ]);

        // WooCommerce
        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');
    }
}
