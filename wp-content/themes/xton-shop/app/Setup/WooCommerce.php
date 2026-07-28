<?php

declare(strict_types=1);

namespace XtonShop\Setup;

use XtonShop\Support\Contracts\Bootable;

/**
 * Integracja z WooCommerce: własne wrappery treści zamiast domyślnych,
 * aby sklep renderował się wewnątrz layoutu motywu (header/footer).
 */
final class WooCommerce implements Bootable
{
    public function boot(): void
    {
        // Nie rób nic, gdy WooCommerce nie jest aktywny.
        if (! class_exists(\WooCommerce::class)) {
            return;
        }

        remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
        remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

        add_action('woocommerce_before_main_content', [$this, 'wrapperOpen'], 10);
        add_action('woocommerce_after_main_content', [$this, 'wrapperClose'], 10);
    }

    public function wrapperOpen(): void
    {
        echo '<main id="main" class="site-main" role="main"><div class="container mx-auto px-4 py-8">';
    }

    public function wrapperClose(): void
    {
        echo '</div></main>';
    }
}
