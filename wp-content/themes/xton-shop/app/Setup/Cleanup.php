<?php

declare(strict_types=1);

namespace XtonShop\Setup;

use XtonShop\Support\Contracts\Bootable;

/**
 * Czyszczenie <head> i wyłączenie zbędnych funkcji dla wydajności/bezpieczeństwa.
 */
final class Cleanup implements Bootable
{
    public function boot(): void
    {
        add_action('init', [$this, 'cleanHead']);
    }

    public function cleanHead(): void
    {
        // Zbędne meta w <head> (wydajność + mniej powierzchni ataku).
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'wp_shortlink_wp_head');
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);

        // Emoji — usuwa render-blocking skrypt i style, gdy nieużywane.
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_styles', 'print_emoji_styles');
        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    }
}
